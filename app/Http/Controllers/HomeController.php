<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\FlavorServiceInterface;


class HomeController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $flavorService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        FlavorServiceInterface $flavorService,
    ) {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->flavorService = $flavorService;
    }

    public function getProductsData($action, $category = null)
    {
        $categories = $this->categoryService->getAll();

        if ($action == 'getAll') {
            $productsData = $this->categoryService->getAllCategoriesProductsAndImages();
            $productsByCategory = null;
        } else {
            $productsData = null;
            $productsByCategory = $this->productService->getProductsAndImagesByCategory($category);
        }

        return [
            'action' => $action,
            'categories' => $categories,
            'productsData' => $productsData,
            'productsByCategory' => $productsByCategory,
            'selectedCategory' => $category,
        ];
    }

    public function index()
    {
        $data = $this->getProductsData('getAll');
        return view('index', $data);
    }

    public function indexByCategory(Category $category)
    {
        $data = $this->getProductsData('byCategory', $category);
        return view('index', $data);
    }


    public function productDetails(Product $product)
    {
        $categories = $this->categoryService->getAll();
        $productData = $this->productService->getProductAndAllImagesByProduct($product);
        $flavors = $this->flavorService->getFlavorsByProduct($product);
        // dd($productData);
        return view('shop.pages.productDetails', [
            'categories' => $categories,
            'product' => $productData,
            'flavors' => $flavors,
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
}
