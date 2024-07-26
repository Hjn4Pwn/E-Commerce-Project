<?php

namespace App\Services\Interfaces;

use App\Models\Category;

/**
 * Interface CategoryServiceInterface
 * @package App\Services\Interfaces
 */
interface CategoryServiceInterface
{
    public function getAllCategories($search = null);
    public function getAllCategoriesProductsAndImages();
    public function storeCategory($validatedData);
    public function updateCategory(Category $category, $validatedData);
    public function deleteCategory(Category $category);
}
