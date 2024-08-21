<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductFlavor;
use App\Models\ProductImage;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\ElasticsearchServiceInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    protected $categoryService;
    protected $imageService;
    protected $elasticsearchService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ImageServiceInterface $imageService,
        ElasticsearchServiceInterface $elasticsearchService,
    ) {
        $this->categoryService = $categoryService;
        $this->imageService = $imageService;
        $this->elasticsearchService = $elasticsearchService;
    }

    public function getAllCategories()
    {
        return $this->categoryService->getAllCategories();
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function storeProduct($validatedData)
    {
        return Product::create($validatedData);
    }

    public function updateProduct(Product $product, $validatedData)
    {
        return $product->update($validatedData);
    }

    public function deleteProduct(Product $product)
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
        $productIds = collect();

        if ($search) {
            $productIds = $this->elasticsearchService->search('app_index', 'product', $search);

            $products = Product::whereIn('id', $productIds)
                ->with(['main_image', 'flavors'])
                ->get();
        } else {
            $products = Product::with(['main_image', 'flavors'])->get(); // Thêm 'flavors' vào để preload dữ liệu
        }
        foreach ($products as $product) {
            $product->quantity = $product->total_quantity; // Sử dụng accessor
        }

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
