<?php

namespace App\Services\Interfaces;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductServiceInterface
{
    public function getAllCategories();
    public function getAll();
    public function store($validatedData);
    public function update(Product $product, $validatedData);
    public function delete(Product $product);
    public function getProductsAndImagesByCategory(Category $category);
    public function getProductsAndImages();
    public function getProductAndAllImagesByProduct(Product $product);
}
