<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Product;


// get
Route::prefix('admin')->group(function () {
    // authen admin
    Route::middleware('admin')->group(function () {
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

        // flavor
        Route::get('flavors', [FlavorController::class, 'index'])
            ->name('admin.flavors.index');

        Route::get('flavors/create', [FlavorController::class, 'create'])
            ->name('admin.flavors.create');

        Route::post('flavors', [FlavorController::class, 'store'])
            ->name('admin.flavors.store');

        Route::get('flavors/{flavor}/edit', [FlavorController::class, 'edit'])
            ->name('admin.flavors.edit');

        Route::put('flavors/{flavor}', [FlavorController::class, 'update'])
            ->name('admin.flavors.update');

        Route::delete('flavors/{flavor}', [FlavorController::class, 'destroy'])
            ->name('admin.flavors.destroy');
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

        Route::get('/config/upload', [ProductController::class, 'showUploadConfig']);

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

    // admin - login - logout
    Route::group(['middleware' => 'guest.admin'], function () {
        Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login.post');
    });
    Route::get('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
});

Route::prefix('user')->group(function () {
});

// frontend call backend
Route::get('getDistricts/{provinceId}', [LocationController::class, 'getDistrictsByProvinceId'])
    ->middleware('AdminLogin')
    ->name('getDistrictsByProvinceId');

Route::get('getWards/{districtId}', [LocationController::class, 'getWardsByDistrictId'])
    ->middleware('AdminLogin')
    ->name('getWardsByDistrictId');


// ------------------------------------------------------------------------------------------------
// Customer Interface
// ------------------------------------------------------------------------------------------------

Route::get('/', [HomeController::class, 'index'])
    ->name('shop.index');

Route::get('products/category/{category}', [HomeController::class, 'indexByCategory'])
    ->name('shop.products.byCategory');

Route::get('product/{product}', [HomeController::class, 'productDetails'])
    ->name('shop.products.productDetails');

Route::get('/login', [HomeController::class, 'login'])
    ->name('shop.login');

Route::get('/register', [HomeController::class, 'register'])
    ->name('shop.register');

// login - register - logout
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthUserController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthUserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthUserController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');

// authen pages
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', function () {
        return view('shop.pages.cart');
    })->name('shop.cart');
});
