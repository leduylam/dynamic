<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;

Route::auth();

Route::group([
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
});
?>
