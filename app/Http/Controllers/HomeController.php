<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\FlavorServiceInterface;
use App\Services\Interfaces\ReviewServiceInterface;
use App\Services\Interfaces\SliderServiceInterface;



class HomeController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $flavorService;
    protected $reviewService;
    protected $sliderService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        FlavorServiceInterface $flavorService,
        ReviewServiceInterface $reviewService,
        SliderServiceInterface $sliderService,
    ) {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->flavorService = $flavorService;
        $this->reviewService = $reviewService;
        $this->sliderService = $sliderService;
    }

    public function getProductsData($action, $category = null, $search = null)
    {
        $categories = $this->categoryService->getAllCategories();
        $sliders = $this->sliderService->getAllSliders();
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
            'sliders' => $sliders
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
        $categories = $this->categoryService->getAllCategories();
        $productData = $this->productService->getProductAndAllImagesByProduct($product);
        $flavors = $this->flavorService->getFlavorsByProduct($product);
        $isOutOfStock = $this->productService->areAllFlavorsOutOfStock($product);
        $reviewData = $this->reviewService->show($product);
        // dd($reviewData);
        return view('shop.pages.productDetails', [
            'categories' => $categories,
            'product' => $productData,
            'flavors' => $flavors,
            'isOutOfStock' => $isOutOfStock,
            'reviews' => $reviewData['reviews'],
            'total_reviews' => $reviewData['total_reviews'],
            'ratings_summary' => $reviewData['ratings_summary'],
            'average_rating' => $reviewData['average_rating'],
            'liked_reviews' => $reviewData['liked_reviews'],
            'reported_reviews' => $reviewData['reported_reviews'],
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
