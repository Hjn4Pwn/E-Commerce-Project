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
    public function getAllProducts();
    public function storeProduct($validatedData);
    public function updateProduct(Product $product, $validatedData);
    public function deleteProduct(Product $product);
    public function getProductsAndImagesByCategory(Category $category);
    public function getProductsAndImages($search = null);
    public function getProductAndAllImagesByProduct(Product $product);
    public function areAllFlavorsOutOfStock(Product $product);
    public function quantity(Product $product);
}
