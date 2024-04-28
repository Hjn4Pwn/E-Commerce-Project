<?php

namespace App\Services;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Models\Category;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService implements CategoryServiceInterface
{
    protected $imageService;

    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getAll()
    {
        // return Category::all(); 
        return Category::with('products')->get();
    }

    public function store($validatedData)
    {
        return Category::create($validatedData);
    }

    public function update(Category $category, $validatedData)
    {
        return $category->update($validatedData);
    }

    public function delete(Category $category)
    {
        $images = $category->products()->pluck('image')->all();
        foreach ($images as $imagePath) {
            $this->imageService->deleteImage($imagePath);
        }

        return $category->products()->delete() && $category->delete();
    }
}
