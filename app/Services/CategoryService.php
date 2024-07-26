<?php

namespace App\Services;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\FlavorServiceInterface;
use App\Models\Category;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService implements CategoryServiceInterface
{
    protected $imageService;
    protected $flavorService;

    public function __construct(
        ImageServiceInterface $imageService,
        FlavorServiceInterface $flavorService
    ) {
        $this->imageService = $imageService;
        $this->flavorService = $flavorService;
    }

    public function getAllCategories($search = null)
    {
        if ($search) {
            return Category::search($search)->where('type', 'category')->get();
        }
        return Category::with('products')->get();
    }

    public function getAllCategoriesProductsAndImages()
    {
        $categories = Category::with('products')->get();
        foreach ($categories as $category) {
            foreach ($category->products as $product) {
                $product->main_image =  $this->imageService->getMainImageForProduct($product);
            }
        }

        return $categories;
    }

    public function storeCategory($validatedData)
    {
        return Category::create($validatedData);
    }

    public function updateCategory(Category $category, $validatedData)
    {
        return $category->update($validatedData);
    }

    public function deleteCategory(Category $category)
    {
        $category->products->each(function ($product) {
            $this->imageService->deleteImagesByProduct($product);
            $this->flavorService->deleteFlavorByProduct($product);
        });

        $category->products()->delete();

        return $category->delete();
    }
}
