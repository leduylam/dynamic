<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dynamic\DynamicSportController;
use App\Http\Controllers\Dynamic\ProductController;
use App\Http\Controllers\Dynamic\CategoryController;
use App\Http\Controllers\Dynamic\OrderController;
use App\Http\Controllers\Auth\LoginController;

Route::group([
    'prefix' => 'customer',
    'as' => 'customer.',
], function () {
    Route::get('/', [LoginController::class, 'showUserLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'userLogin'])->name('login.success');
});

Route::group([
    ['middleware' => ['auth:user']],
], function () {
    Route::get('/', [DynamicSportController::class, 'home'])->name('welcome');

    Route::group([
        'prefix' => 'product',
        'as' => 'product.'
    ], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('product-table/', [ProductController::class, 'tableProduct'])->name('product-table');
        Route::get('/product-detail/{id}', [ProductController::class, 'productDetail'])->name('product-detail');
        // Route::post('/add-to-card', [ProductController::class, 'addtoCard'])->name('add-to-card');
    });

    Route::group([
        'prefix' => 'cart',
        'as' => 'cart.'
    ], function(){
        Route::get('/', [OrderController::class, 'index'])->name('index');
    });
    });
?>
