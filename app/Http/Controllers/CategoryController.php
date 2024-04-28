<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Interfaces\CategoryServiceInterface;

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
    public function index()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.pages.category.categories', [
            'categories' => $categories,
            'page' => 'Categories',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.createCategory', [
            'parentPage' => ['Categories', 'admin.categories.index'],
            'childPage' => 'Create',
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();
        if ($this->categoryService->store($validatedData)) {
            return redirect()->route('admin.categories.index')->with('success', 'Create Category successfully');
        }
        return back()->withErrors('Failed to create category.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.pages.category.editCategory', [
            'category' => $category,
            'parentPage' => ['Categories', 'admin.categories.index'],
            'childPage' => 'Edit',
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
        if ($this->categoryService->update($category, $validatedData)) {
            return redirect()->route('admin.categories.index')->with('success', 'Update Category successfully');
        }
        return back()->withErrors('Failed to update category.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($this->categoryService->delete($category)) {
            return redirect()->route('admin.categories.index')->with('success', 'Delete category and its products successfully');
        }
        return back()->withErrors('Failed to delete category and its products.');
        
    }
}
