<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductFlavor;
use App\Models\ProductImage;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\FlavorServiceInterface;
use Illuminate\Support\Facades\DB;
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
    protected $imageService;
    protected $flavorService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ImageServiceInterface $imageService,
        FlavorServiceInterface $flavorService,
    ) {
        $this->categoryService = $categoryService;
        $this->imageService = $imageService;
        $this->flavorService = $flavorService;
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

    public function getProductsAndImagesByCategory(Category $category)
    {
        $products = $category->products()->with(['category', 'main_image'])->get();

        return $products;
    }

    public function getProductsAndImages($search = null)
    {
        // dd($search);
        if ($search) {
            // $products = Product::search($search)
            //     ->where('type', 'product')
            //     ->with(['main_image', 'flavors'])
            //     ->get();
            $productIds = Product::search($search)
                ->where('type', 'product')
                ->get()
                ->pluck('id');

            $products = Product::whereIn('id', $productIds)
                ->with(['main_image', 'flavors'])
                ->get();
        } else {
            $products = Product::with(['main_image', 'flavors'])->get(); // Thêm 'flavors' vào để preload dữ liệu
        }
        foreach ($products as $product) {
            $product->quantity = $product->total_quantity; // Sử dụng accessor
        }
        // dd($products);

        return $products;
    }


    public function getProductAndAllImagesByProduct(Product $product)
    {
        return $product->load(['images', 'flavors']);
    }

    public function areAllFlavorsOutOfStock(Product $product)
    {
        return $product->flavors->every(function ($productFlavor) {
            return $productFlavor->pivot->quantity == 0;
        });
    }

    public function quantity(Product $product)
    {
        return $product->flavors->sum(function ($productFlavor) {
            return $productFlavor->pivot->quantity;
        });
    }
}
