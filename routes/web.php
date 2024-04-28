<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

// get
Route::prefix('admin')->group(function () {
    // authen admin
    Route::middleware('AdminAuth')->group(function () {
        // view
        Route::get('/', function () {
            return view('admin.pages.index', [
                'page' => 'Dashboard',
            ]);
        })->name('admin.index');

        Route::get('orders', function () {
            return view('admin.pages.order.orders', [
                'page' => 'Orders',
            ]);
        })->name('admin.orders');

        Route::get('viewOrder', function () {
            return view('admin.pages.order.viewOrder', [
                'parentPage' => ['Orders', 'admin.orders'],
                'childPage' => 'Details',
            ]);
        })->name('admin.viewOrder');

        // user
        Route::get('users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::get('users/{user}/edit', [UserController::class, 'edit'])
            ->name('admin.users.edit');

        Route::put('users/{user}', [UserController::class, 'update'])
            ->name('admin.users.update');

        Route::delete('users/{user}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');
        // --------------------------------------------------------------

        // category
        Route::get('categories', [CategoryController::class, 'index'])
            ->name('admin.categories.index');

        Route::get('categories/create', [CategoryController::class, 'create'])
            ->name('admin.categories.create');

        Route::post('categories', [CategoryController::class, 'store'])
            ->name('admin.categories.store');

        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('admin.categories.edit');

        Route::put('categories/{category}', [CategoryController::class, 'update'])
            ->name('admin.categories.update');

        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
            ->name('admin.categories.destroy');
        // --------------------------------------------------------------

        // product
        Route::get('products', [ProductController::class, 'index'])
            ->name('admin.products.index');

        Route::get('products/category/{category}', [ProductController::class, 'indexByCategory'])
            ->name('admin.products.byCategory');

        Route::get('products/create', [ProductController::class, 'create'])
            ->name('admin.products.create');

        Route::post('products', [ProductController::class, 'store'])
            ->name('admin.products.store');

        Route::get('products/{product}/edit', [ProductController::class, 'edit'])
            ->name('admin.products.edit');

        Route::put('products/{product}', [ProductController::class, 'update'])
            ->name('admin.products.update');

        Route::delete('products/{product}', [ProductController::class, 'destroy'])
            ->name('admin.products.destroy');

        // --------------------------------------------------------------



        // info
        Route::get('editAdminProfile', function () {
            return view('admin.pages.AdminInfo.editAdminProfile', [
                'page' => 'Admin Profile',
            ]);
        })->name('admin.editAdminProfile');

        Route::get('changePassword', function () {
            return view('admin.pages.AdminInfo.changePassword', [
                'page' => 'Admin Change Password',
            ]);
        })->name('admin.changePassword');
    });

    // login
    Route::get('login', function () {
        return view('admin.pages.login');
    })
        ->middleware('AdminLogin')
        ->name('admin.login');

    // logout
    Route::get('/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');
});

// post
Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminController::class, 'auth'])->name('admin.auth');
});

// frontend call backend
Route::get('getDistricts/{provinceId}', [LocationController::class, 'getDistrictsByProvinceId'])
    ->middleware('AdminLogin')
    ->name('getDistrictsByProvinceId');

Route::get('getWards/{districtId}', [LocationController::class, 'getWardsByDistrictId'])
    ->middleware('AdminLogin')
    ->name('getWardsByDistrictId');
