<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;

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


});

Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);
});

Route::get('logout', [AuthController::class, 'logout']);