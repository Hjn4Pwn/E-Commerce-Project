<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\FlavorServiceInterface;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $imageService;
    protected $flavorService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        ImageServiceInterface $imageService,
        FlavorServiceInterface $flavorService,
    ) {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->imageService = $imageService;
        $this->flavorService = $flavorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $search = $request->input('search');
        $outOfStockProducts = collect();

        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getProductsAndImages($search);

        foreach ($products as $product) {
            if ($this->productService->areAllFlavorsOutOfStock($product)) {
                $outOfStockProducts->push($product->id);
            }
        }

        session(['selectedCategory' => 'all']);

        return view('admin.pages.product.index', [
            'selectedCategory' => 'all',
            'products' => $products,
            'categories' => $categories,
            'outOfStockProducts' => $outOfStockProducts,
            'page' => 'Sản phẩm',
            'search' => $search
        ]);
    }

    public function indexByCategory(Category $category)
    {

        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getProductsAndImagesByCategory($category);
        $outOfStockProducts = collect();

        foreach ($products as $product) {
            if ($this->productService->areAllFlavorsOutOfStock($product)) {
                $outOfStockProducts->push($product->id);
            }
        }

        session(['selectedCategory' => $category->id]);
        return view('admin.pages.product.index', [
            // 'selectedCategory' => $category->id,
            'categories' => $categories,
            'products' => $products,
            'outOfStockProducts' => $outOfStockProducts,
            'page' => 'Sản phẩm',
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        $flavors = $this->flavorService->getAllFlavors();
        return view('admin.pages.product.create', [
            // 'products' => $products,
            'categories' => $categories,
            'flavors' => $flavors,
            'parentPage' => ['Sản phẩm', 'admin.products.index'],
            'childPage' => 'Tạo',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request);
        // dd($request->input('flavor_quantities')[11]);
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            // product
            $product = $this->productService->storeProduct($validatedData);

            $pathsToDeleteIfFailed = [];

            // images
            for ($i = 1; $i <= 4; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $image = Image::make($request->file('image' . $i));

                    // Kiểm tra định dạng JPEG và kiểm tra malware
                    if ($image->mime() === 'image/jpeg' || $image->mime() === 'image/jpg') {
                        $result = $this->imageService->checkMalwareJPEG(
                            $request->file('image' . $i)->getPathname(),
                            $request->file('image' . $i)->getClientOriginalName()
                        );

                        if ($result === 'malicious') {
                            DB::rollBack();
                            return back()->with('error', 'Một hoặc nhiều tệp JPEG có chứa mã độc.');
                        }
                    }

                    $path = $this->imageService->removeBackgroundAndStore($request, 'image' . $i);
                    $this->imageService->storeProductImage($product, $path, $i);
                    $pathsToDeleteIfFailed[] = $path;
                }
            }

            // flavors
            if ($request->has('flavors')) {
                foreach ($request->input('flavors') as $id) {
                    $flavor_quantity = $request->input('flavor_quantities')[$id];
                    $this->flavorService->storeProductFlavor($product, $id, $flavor_quantity);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Tạo sản phẩm thất bại: ' . $e->getMessage());

            return back()->withErrors('Tạo sản phẩm thất bại.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = $this->categoryService->getAllCategories();
        $flavors = $this->flavorService->getFlavorsWithCheckedStatus($product);
        $images = $this->imageService->getImagesByProduct($product);
        session(['selectedCategory' => $product->category_id]);
        return view('admin.pages.product.edit', [
            'categories' => $categories,
            'product' => $product,
            'flavors' => $flavors,
            'images' => $images,
            'parentPage' => ['Sản phẩm', 'admin.products.index'],
            'childPage' => 'Chỉnh sửa',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request);
        $validatedData = $request->validated();

        // Lấy path ảnh cũ
        $oldImagePaths = $product->images->pluck('path', 'sort_order')->toArray();

        DB::beginTransaction();
        try {
            // product
            $this->productService->updateProduct($product, $validatedData);

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

                $this->flavorService->updateProductFlavors($product, $request->input('flavors'), $request->input('flavor_quantities'));
            }

            DB::commit();

            // Xóa các ảnh cũ sau khi commit thành công
            foreach ($pathsToDelete as $path) {
                $this->imageService->deleteImage($path);
                $this->imageService->deleteImagesByPath($path);
            }

            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product: ' . $e->getMessage());
            return back()->withErrors('Cập nhật sản phẩm thất bại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $this->flavorService->deleteFlavorByProduct($product);
            $this->imageService->deleteImagesByProduct($product);
            $this->productService->deleteProduct($product);

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Xóa sản phẩm thất bại: ' . $e->getMessage());
        }
    }
}
