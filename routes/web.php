<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\Google2FAController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\SliderController;
use App\Models\Product;


// get
Route::prefix('admin')->group(function () {
    // authen admin
    Route::middleware('admin')->group(function () {

        // view
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // user
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        // --------------------------------------------------------------

        // category
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        // --------------------------------------------------------------

        // flavor
        Route::get('flavors', [FlavorController::class, 'index'])->name('admin.flavors.index');
        Route::get('flavors/create', [FlavorController::class, 'create'])->name('admin.flavors.create');
        Route::post('flavors', [FlavorController::class, 'store'])->name('admin.flavors.store');
        Route::get('flavors/{flavor}/edit', [FlavorController::class, 'edit'])->name('admin.flavors.edit');
        Route::put('flavors/{flavor}', [FlavorController::class, 'update'])->name('admin.flavors.update');
        Route::delete('flavors/{flavor}', [FlavorController::class, 'destroy'])->name('admin.flavors.destroy');

        // Route::get('admin/flavors', [FlavorController::class, 'index'])->name('admin.flavors.index');
        // --------------------------------------------------------------

        // product
        Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('products/category/{category}', [ProductController::class, 'indexByCategory'])->name('admin.products.byCategory');
        Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/config/upload', [ProductController::class, 'showUploadConfig']);
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

        // --------------------------------------------------------------
        // order
        Route::get('orders', [OrderController::class, 'admin_index'])->name('admin.orders.index');
        Route::get('orders/{id}', [OrderController::class, 'admin_viewOrder'])->name('admin.viewOrder');
        Route::post('orders/{order}/ship', [OrderController::class, 'ship'])->name('orders.ship');
        Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.admin_cancel');
        Route::post('/orders/{order}/confirm-receipt', [OrderController::class, 'confirmReceipt'])->name('orders.confirmReceipt');
        // --------------------------------------------------------------

        // review
        Route::get('reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
        Route::get('reviews/{review}/edit', [ReviewController::class, 'admin_show'])->name('admin.reviews.show');
        Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');

        // --------------------------------------------------------------
        // info
        Route::get('profile', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('profile', [AdminController::class, 'update'])->name('admin.update');
        Route::get('change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::put('change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');


        // slider
        Route::get('sliders', [SliderController::class, 'index'])->name('admin.sliders.index');
        Route::get('sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
        Route::post('sliders', [SliderController::class, 'store'])->name('admin.sliders.store');
        Route::delete('sliders/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');

        // 2fa
        Route::get('2fa/enable', [Google2FAController::class, 'showEnable2faForm'])->name('2fa.enable.form');
        Route::post('2fa-enable', [Google2FAController::class, 'verifyEnable2fa'])->name('2fa.enable.verify');
        Route::post('2fa/disable', [Google2FAController::class, 'disable2fa'])->name('2fa.disable');
    });

    // admin - login - logout
    Route::group(['middleware' => 'guest.admin'], function () {
        Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login.post');
        Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('admin.resetPassword');
        Route::get('/reset-password', [AdminController::class, 'showResetPasswordForm'])->name('admin.showResetPasswordForm');
    });
    Route::get('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

    Route::post('/send-verification-code', [AuthAdminController::class, 'sendVerificationCode'])->name('admin.send.verification.code');

    // 2fa
    Route::post('2fa/validate', [Google2FAController::class, 'validate2fa'])->name('2fa.validate');
    Route::get('2fa/validate', [Google2FAController::class, 'showValidate2faForm'])->name('2fa.validate.form');
});




Route::prefix('user')->group(function () {
});

// frontend call backend
Route::get('getDistricts/{provinceId}', [LocationController::class, 'getDistrictsByProvinceId'])
    // ->middleware('admin')
    ->name('getDistrictsByProvinceId');

Route::get('getWards/{districtId}', [LocationController::class, 'getWardsByDistrictId'])
    // ->middleware('admin')
    ->name('getWardsByDistrictId');


// ------------------------------------------------------------------------------------------------
// Customer Interface
// ------------------------------------------------------------------------------------------------

Route::get('/', [HomeController::class, 'index'])->name('shop.index');
Route::get('products/category/{category}', [HomeController::class, 'indexByCategory'])->name('shop.products.byCategory');
Route::get('product/{product}', [HomeController::class, 'productDetails'])->name('shop.products.productDetails');

// reviews by product
Route::get('/product/{product}/reviews', [ReviewController::class, 'show'])->name('reviews.show');

// login - register - logout
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthUserController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthUserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthUserController::class, 'register'])->name('register.post');
    Route::get('/reset-password', [UserController::class, 'showResetPasswordForm'])->name('user.showResetPasswordForm');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('user.resetPassword');

    // login facebook
    Route::get('auth/facebook', [AuthUserController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('auth/facebook/callback', [AuthUserController::class, 'handleFacebookCallback']);

    // login google
    Route::get('auth/google', [AuthUserController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [AuthUserController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');


Route::post('/send-verification-code', [AuthUserController::class, 'sendVerificationCode'])->name('send.verification.code');
Route::post('/verify-code', [AuthUserController::class, 'verifyCode'])->name('verify.code');



// authen pages
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'removeItem'])->name('cart.removeItem');

    // order
    Route::post('/order/store-temporary', [OrderController::class, 'storeTemporary'])->name('order.storeTemporary');
    Route::get('/order/review', [OrderController::class, 'review'])->name('order.review');
    Route::post('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirmOrder');
    Route::get('/order/show', [OrderController::class, 'show'])->name('order.show');
    Route::post('/update-address', [OrderController::class, 'updateAddress'])->name('updateAddress');
    Route::post('/update-phone', [OrderController::class, 'updatePhone'])->name('updatePhone');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // vnpay-payment
    // Route::get('vnpay-payment', [VNPayController::class, 'createPayment'])->name('vnpay.payment');
    Route::get('vnpay-payment/{order}', [VNPayController::class, 'createPayment'])->name('vnpay.payment');
    Route::get('vnpay-return', [VNPayController::class, 'returnPayment'])->name('vnpay.return');

    // Rating
    Route::post('/products/{product}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/reviews/{review}/like', [ReviewController::class, 'like'])->name('reviews.like');
    Route::post('/reviews/{review}/report', [ReviewController::class, 'report'])->name('reviews.report');

    // User Profile
    Route::get('/user/edit-profile', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::put('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');


    Route::get('/user/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.showChangePasswordForm');
    Route::put('/user/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
});

// Route::get('test', [Google2FAController::class, 'test'])->name('test');
