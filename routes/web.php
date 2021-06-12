<?php

use Illuminate\Support\Facades\Route;
//Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

//Frontend Controller
use App\Http\Controllers\Dynamic\DynamicSportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DynamicSportController::class, 'home']);


Route::prefix('/admin')->namespace('Admin')->group(function(){
    Route::get('/login', [AdminController::class, 'login']);
    Route::get('/dashboard', [AdminController::class, 'dashboard']) -> name('admin.dashboard');
    // Admin Categories Route
    Route::prefix('/category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('admin.list.category');
        // Create Category Route
        Route::get('create', [CategoryController::class, 'create'])->name('admin.create.category');
        Route::post('create', [CategoryController::class, 'store']);
        // Update Category Route
        Route::get('edit', [CategoryController::class, 'edit'])->name('admin.edit.category');
        Route::post('edit', [CategoryController::class, 'update']);
        // Active Category Route 
        Route::get('status/{id}', [CategoryController::class, 'destroy']);

        // Delete Category Route
        Route::get('delete/{id}', [CategoryController::class, 'destroy']);
    });
    // Admin products route
    Route::prefix('/product')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('admin.list.product');
        // Create Category Route
        Route::get('create', [ProductController::class, 'create'])->name('admin.create.product');
        Route::post('create', [ProductController::class, 'store']);
        // Update Category Route
        Route::get('edit', [ProductController::class, 'edit']);
        Route::post('edit', [ProductController::class, 'update']);
        // Active Category Route
        Route::get('status/{id}', [ProductController::class, 'destroy']);

        // Delete Category Route
        Route::get('delete/{id}', [ProductController::class, 'destroy']);
    });
});
