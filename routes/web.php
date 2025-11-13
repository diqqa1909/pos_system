<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;

Route::get('/', [AuthController::class, 'login']);
Route::post('login_post', [AuthController::class, 'login_post']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/data', [CategoryController::class, 'getCategories']);
    Route::post('admin/category/store', [CategoryController::class, 'store']);
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/update/{id}', [CategoryController::class, 'update']);
    Route::post('admin/category/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('admin/product', [ProductController::class, 'index']);
    Route::post('admin/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('admin/product/fetch', [ProductController::class, 'fetchProducts'])->name('product.fetch');
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('admin/product/update/{id}', [ProductController::class, 'update']);
    Route::delete('admin/product/delete/{id}', [ProductController::class, 'destroy']);

    Route::get('admin/member', [MemberController::class, 'index']);
    Route::get('admin/member/add', [MemberController::class, 'add']);
    Route::post('admin/member/add', [MemberController::class, 'save']);
    Route::get('admin/member/edit/{id}', [MemberController::class, 'edit']);
    Route::post('admin/member/edit/{id}', [MemberController::class, 'update']);
    Route::get('admin/member/delete/{id}', [MemberController::class, 'delete']);

    Route::get('admin/supplier', [SupplierController::class, 'index']);
    Route::get('admin/supplier/delete/{id}', [SupplierController::class, 'delete']);
    Route::get('admin/supplier/add/', [SupplierController::class, 'add']);
    Route::post('admin/supplier/add/', [SupplierController::class, 'store']);
    Route::get('admin/supplier/edit/{id}', [SupplierController::class, 'edit']);
    Route::post('admin/supplier/edit/{id}', [SupplierController::class, 'update']);
    
    Route::get('admin/expense', [ExpenseController::class, 'index']);
    Route::get('admin/expense/add', [ExpenseController::class, 'add']);
    Route::post('admin/expense/add', [ExpenseController::class, 'store']);
    Route::get('admin/expense/edit/{id}', [ExpenseController::class, 'edit']);
    Route::post('admin/expense/edit/{id}', [ExpenseController::class, 'update']);
    Route::get('admin/expense/delete/{id}', [ExpenseController::class, 'delete']);

    Route::get('admin/purchase', [PurchaseController::class, 'index']);
    Route::get('admin/purchase/add', [PurchaseController::class, 'add']);
    Route::post('admin/purchase/add', [PurchaseController::class, 'store']); 
    Route::get('admin/purchase/edit/{id}', [PurchaseController::class, 'edit']); 
    Route::post('admin/purchase/edit/{id}', [PurchaseController::class, 'update']); 
    Route::get('admin/purchase/delete/{id}', [PurchaseController::class, 'delete']);
    
    Route::get('admin/sales', [SalesController::class, 'index']);
    Route::get('admin/sales/add', [SalesController::class, 'add']);
    Route::post('admin/sales/add', [SalesController::class, 'store']);
    Route::get('admin/sales/edit/{id}', [SalesController::class, 'edit']);
    Route::post('admin/sales/edit/{id}', [SalesController::class, 'update']);
    Route::get('admin/sales/delete/{id}', [SalesController::class, 'delete']);
    Route::get('admin/sales/delete_all', [SalesController::class, 'delete_all']);
    

});

Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);
});

Route::get('logout', [AuthController::class, 'logout']);