<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\FlavorServiceInterface;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    protected $productService;
    protected $imageService;
    protected $flavorService;

    public function __construct(
        ProductServiceInterface $productService,
        ImageServiceInterface $imageService,
        FlavorServiceInterface $flavorService,
    ) {
        $this->productService = $productService;
        $this->imageService = $imageService;
        $this->flavorService = $flavorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = $this->productService->getAll();
        $categories = $this->productService->getAllCategories();
        $products = $this->productService->getProductsAndImages();
        session(['selectedCategory' => 'all']);
        return view('admin.pages.product.products', [
            'selectedCategory' => 'all',
            'products' => $products,
            'categories' => $categories,
            'page' => 'Products',
        ]);
    }

    public function indexByCategory(Category $category)
    {
        $categories = $this->productService->getAllCategories();
        $products = $this->productService->getProductsByCategoryAndImages($category);
        // dd($products);
        session(['selectedCategory' => $category->id]);
        return view('admin.pages.product.products', [
            // 'selectedCategory' => $category->id,
            'categories' => $categories,
            'products' => $products,
            'page' => 'Products',
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->productService->getAllCategories();
        $flavors = $this->flavorService->getAll();
        return view('admin.pages.product.createProduct', [
            // 'products' => $products,
            'categories' => $categories,
            'flavors' => $flavors,
            'parentPage' => ['Products', 'admin.products.index'],
            'childPage' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            // product
            $product = $this->productService->store($validatedData);

            $pathsToDeleteIfFailed = [];

            // images
            for ($i = 1; $i <= 4; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $path = $this->imageService->removeBackgroundAndStore($request, 'image' . $i);
                    $this->imageService->storeProductImage($product, $path, $i);
                    $pathsToDeleteIfFailed[] = $path;
                }
            }

            // flavors
            if ($request->has('flavors')) {
                foreach ($request->input('flavors') as $id) {
                    $this->flavorService->storeProductFlavor($product, $id);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Create product successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product: ' . $e->getMessage());

            foreach ($pathsToDeleteIfFailed as $path) {
                $this->imageService->deleteImage($path);
            }

            return back()->withErrors('Failed to create product.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // sau này sẽ cho view product details thay vì hiện tại view bằng edit
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = $this->productService->getAllCategories();
        $flavors = $this->flavorService->getFlavorsWithCheckedStatus($product);
        $images = $this->imageService->getImagesByProduct($product);
        session(['selectedCategory' => $product->category_id]);
        return view('admin.pages.product.editProduct', [
            'categories' => $categories,
            'product' => $product,
            'flavors' => $flavors,
            'images' => $images,
            'parentPage' => ['Products', 'admin.products.index'],
            'childPage' => 'Edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        // Lấy path ảnh cũ
        $oldImagePaths = $product->images->pluck('path', 'sort_order')->toArray();

        DB::beginTransaction();
        try {
            // product
            $this->productService->update($product, $validatedData);

            $pathsToDelete = [];

            // images
            for ($i = 1; $i <= 4; $i++) {
                $imageField = 'image' . $i;
                if ($request->hasFile($imageField)) {
                    $path = $this->imageService->removeBackgroundAndStore($request, $imageField);
                    $this->imageService->storeProductImage($product, $path, $i);

                    if (!empty($oldImagePaths[$i]) && $oldImagePaths[$i] !== $path) {
                        $pathsToDelete[] = $oldImagePaths[$i];
                    }
                }
            }

            // flavors
            if ($request->has('flavors')) {
                $this->flavorService->updateProductFlavors($product, $request->input('flavors'));
            }

            DB::commit();

            // Xóa các ảnh cũ sau khi commit thành công
            foreach ($pathsToDelete as $path) {
                $this->imageService->deleteImage($path);
                $this->imageService->deleteImagesByPath($path);
            }

            return redirect()->route('admin.products.index')->with('success', 'Update product successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product: ' . $e->getMessage());
            return back()->withErrors('Failed to update product.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Bug:
     * Nhỡ mà bị lỗi không xóa được products
     * Thì lúc này tuy rollBack được dữ liệu trong DB
     * Nhưng hình ảnh thật sự trên server đã bị xóa
     * 
     * Vấn đề này đã xử lý ở store và update, nhưng chưa xử lý khi xóa sản phẩm
     * 
     * Sẽ fix bug này sau...
     * 
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $this->flavorService->deleteFlavorByProduct($product);
            $this->imageService->deleteImagesByProduct($product);
            $this->productService->delete($product);

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Failed to delete product: ' . $e->getMessage());
        }
    }
}
