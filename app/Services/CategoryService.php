<?php

namespace App\Services;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\FlavorServiceInterface;
use App\Services\Interfaces\ElasticsearchServiceInterface;
use App\Models\Category;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService implements CategoryServiceInterface
{
    protected $imageService;
    protected $flavorService;
    protected $elasticsearchService;

    public function __construct(
        ImageServiceInterface $imageService,
        FlavorServiceInterface $flavorService,
        ElasticsearchServiceInterface $elasticsearchService,

    ) {
        $this->imageService = $imageService;
        $this->flavorService = $flavorService;
        $this->elasticsearchService = $elasticsearchService;
    }

    public function getAllCategories($search = null)
    {
        if ($search) {
            $ids = $this->elasticsearchService->search('app_index', 'category', $search);
            return Category::whereIn('id', $ids)->get();
        }

        return Category::with('products')->get();
    }

    public function getAllCategoriesProductsAndImages()
    {
        $categories = Category::with(['products.main_image'])->get();
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
