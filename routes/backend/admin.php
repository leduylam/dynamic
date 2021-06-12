<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::auth();

Route::group([
    'middleware' => 'auth',
    'as' => 'admin.',
], function () {
    // page home
    Route::get('/dashboard', [AdminController::class,'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');

    //page product
    Route::group([
        'prefix' => 'product',
        'as' => 'product.',
    ], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
    });

    //page category
    Route::group([
        'prefix' => 'category',
        'as' => 'category.',
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
    });
});
?>
