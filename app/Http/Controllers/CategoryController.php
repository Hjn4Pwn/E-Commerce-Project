<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(
        CategoryServiceInterface $categoryService
    ) {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $search = $request->input('search');
        $categories = $this->categoryService->getAllCategories($search);
        return view('admin.pages.category.index', [
            'categories' => $categories,
            'page' => 'Danh mục',
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create', [
            'parentPage' => ['Danh mục', 'admin.categories.index'],
            'childPage' => 'Tạo',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();
        if ($this->categoryService->storeCategory($validatedData)) {
            return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công.');
        }
        return back()->withErrors('Tạo danh mục thất bại.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', [
            'category' => $category,
            'parentPage' => ['Danh mục', 'admin.categories.index'],
            'childPage' => 'Chỉnh sửa',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
        if ($this->categoryService->updateCategory($category, $validatedData)) {
            return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công.');
        }
        return back()->withErrors('Cập nhật danh mục thất bại.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($this->categoryService->deleteCategory($category)) {
            return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục và các sản phẩm thuộc danh mục đó thành công');
        }
        return back()->withErrors('Xóa danh mục và các sản phẩm thuộc danh mục đó thất bại.');
    }
}
