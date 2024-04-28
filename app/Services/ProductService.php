<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;

use Illuminate\Support\Facades\Storage;

// use Intervention\Image\Laravel\Facades\Image;
// use Intervention\Image\Facades\Image;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{

    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAllCategories()
    {
        return $this->categoryService->getAll();
    }

    public function getAll()
    {
        return Product::all();
    }

    public function store($validatedData)
    {
        return Product::create($validatedData);
    }

    public function update(Product $product, $validatedData)
    {
        return $product->update($validatedData);
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }

    public function getProductsByCategory(Category $category)
    {
        // return $category->products;
        return Product::with('category')->where('categoryId', $category->id)->get();
    }
}
