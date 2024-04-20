<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {

    // view
    Route::get('/', function () {
        return view('admin.pages.index', [
            'page' => 'Dashboard',
        ]);
    })->name('admin.index');

    Route::get('customers', function () {
        return view('admin.pages.customer.customers', [
            'page' => 'Customers',
        ]);
    })->name('admin.customers');

    Route::get('categories', function () {
        return view('admin.pages.category.categories', [
            'page' => 'Categories',
        ]);
    })->name('admin.categories');

    Route::get('products', function () {
        return view('admin.pages.product.products', [
            'page' => 'Products',
        ]);
    })->name('admin.products');

    Route::get('orders', function () {
        return view('admin.pages.order.orders', [
            'page' => 'Orders',
        ]);
    })->name('admin.orders');

    // subPage - action
    Route::get('addCategory', function () {
        return view('admin.pages.category.addCategory', [
            'parentPage' => ['Categories', 'admin.categories'],
            'childPage' => 'Add',
        ]);
    })->name('admin.addCategory');

    Route::get('addProduct', function () {
        return view('admin.pages.product.addProduct', [
            'parentPage' => ['Products', 'admin.products'],
            'childPage' => 'Add',
        ]);
    })->name('admin.addProduct');

    Route::get('viewOrder', function () {
        return view('admin.pages.order.viewOrder', [
            'parentPage' => ['Orders', 'admin.orders'],
            'childPage' => 'Details',
        ]);
    })->name('admin.viewOrder');

    Route::get('editCustomer', function () {
        return view('admin.pages.customer.editCustomer', [
            'parentPage' => ['Customers', 'admin.customers'],
            'childPage' => 'Edit',
        ]);
    })->name('admin.editCustomer');

    Route::get('editCategory', function () {
        return view('admin.pages.category.editCategory', [
            'parentPage' => ['Categories', 'admin.categories'],
            'childPage' => 'Edit',
        ]);
    })->name('admin.editCategory');

    Route::get('editProduct', function () {
        return view('admin.pages.product.editProduct', [
            'parentPage' => ['Products', 'admin.products'],
            'childPage' => 'Edit',
        ]);
    })->name('admin.editProduct');

    Route::get('editCustomer', function () {
        return view('admin.pages.customer.editCustomer', [
            'parentPage' => ['Customers', 'admin.customers'],
            'childPage' => 'Edit',
        ]);
    })->name('admin.editCustomer');

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

    // login
    Route::get('login', function () {
        return view('admin.pages.login');
    })->name('admin.login');
});
