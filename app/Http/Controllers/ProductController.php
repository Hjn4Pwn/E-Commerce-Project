<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    protected $productService;
    protected $imageService;

    public function __construct(
        ProductServiceInterface $productService,
        ImageServiceInterface $imageService
    ) {
        $this->productService = $productService;
        $this->imageService = $imageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAll();
        $categories = $this->productService->getAllCategories();
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
        $products = $this->productService->getProductsByCategory($category);
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
        return view('admin.pages.product.createProduct', [
            // 'products' => $products,
            'categories' => $categories,
            'parentPage' => ['Products', 'admin.products.index'],
            'childPage' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreProductRequest $request)
    {
        // dd($request);
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $path = $this->imageService->removeBackgroundAndStore($request);
            $validatedData['image'] = $path;
        }
        if ($this->productService->store($validatedData)) {
            return redirect()->route('admin.products.index')->with('success', 'Create product successfully');
        }
        return back()->withErrors('Failed to create product.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = $this->productService->getAllCategories();
        session(['selectedCategory' => $product->categoryId]);
        return view('admin.pages.product.editProduct', [
            'categories' => $categories,
            'product' => $product,
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
        $oldImagePath = $product->image;

        if ($request->hasFile('image')) {
            $path = $this->imageService->removeBackgroundAndStore($request);
            $validatedData['image'] = $path;
        }

        if ($this->productService->update($product, $validatedData)) {
            if ($oldImagePath && $oldImagePath != $product->image) {
                $this->imageService->deleteImage($oldImagePath); // Xóa ảnh cũ nếu cập nhật ảnh mới thành công
            }

            return redirect()->route('admin.products.index')->with('success', 'Update product successfully');
        }
        return back()->withErrors('Failed to update product.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $oldImagePath = $product->image;
        if ($this->productService->delete($product)) {
            $this->imageService->deleteImage($oldImagePath);
            // unlink($oldImagePath);
            return redirect()->route('admin.products.index')->with('success', 'Delete product successfully');
        }
        return back()->withErrors('Failed to delete product.');
    }
}
