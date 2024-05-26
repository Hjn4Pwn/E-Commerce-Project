<?php

namespace App\Services\Interfaces;

use App\Models\Category;

/**
 * Interface CategoryServiceInterface
 * @package App\Services\Interfaces
 */
interface CategoryServiceInterface
{
    public function getAll();
    public function getAllCategoriesProductsAndImages();
    public function store($validatedData);
    public function update(Category $category, $validatedData);
    public function delete(Category $category);
}
