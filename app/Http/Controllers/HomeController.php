<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
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

    public function getProductsData($action, $category = null, $search = null)
    {
        $categories = $this->categoryService->getAll();
        $outOfStockProducts = collect();

        if ($action == 'getAll') {

            if ($search) {
                // Thực hiện tìm kiếm sản phẩm bằng Elasticsearch
                $productsData = $this->productService->getProductsAndImages($search);
                // dd($productsData);
                foreach ($productsData as $product) {
                    if ($this->productService->areAllFlavorsOutOfStock($product)) {
                        $outOfStockProducts->push($product->id);
                    }
                }
            } else {
                $productsData = $this->categoryService->getAllCategoriesProductsAndImages();
                // Kiểm tra và lấy ra các sản phẩm hết hàng
                foreach ($productsData as $category) {
                    foreach ($category->products as $product) {
                        if ($this->productService->areAllFlavorsOutOfStock($product)) {
                            $outOfStockProducts->push($product->id);
                        }
                    }
                }
            }


            $productsByCategory = null;
        } else {
            $productsData = null;
            $productsByCategory = $this->productService->getProductsAndImagesByCategory($category);

            // Kiểm tra và lấy ra các sản phẩm hết hàng
            foreach ($productsByCategory as $product) {
                if ($this->productService->areAllFlavorsOutOfStock($product)) {
                    $outOfStockProducts->push($product->id);
                }
            }
        }
        // dd($outOfStockProducts);
        return [
            'action' => $action,
            'categories' => $categories,
            'productsData' => $productsData,
            'productsByCategory' => $productsByCategory,
            'outOfStockProducts' => $outOfStockProducts,
            'selectedCategory' => $category,
            'search' => $search,
        ];
    }

    public function index(SearchRequest $request)
    {
        $search = $request->input('search');
        $data = $this->getProductsData('getAll', null, $search);
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
        $isOutOfStock = $this->productService->areAllFlavorsOutOfStock($product);
        // dd($productData);
        return view('shop.pages.productDetails', [
            'categories' => $categories,
            'product' => $productData,
            'flavors' => $flavors,
            'isOutOfStock' => $isOutOfStock,
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
