<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dynamic\DynamicSportController;
use App\Http\Controllers\Dynamic\ProductController;
use App\Http\Controllers\Dynamic\CategoryController;
use App\Http\Controllers\Dynamic\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dynamic\UserController;

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
            Route::get('/product-table', [ProductController::class, 'tableProduct'])->name('product-table');
            Route::get('/product-detail/{id}', [ProductController::class, 'productDetail'])->name('product-detail');
            Route::post('/add-to-card', [ProductController::class, 'addtoCard'])->name('add-to-card');
        });

        Route::group([
            'prefix' => 'cart',
            'as' => 'cart.'
        ], function(){
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        });
        Route::get('/account', [UserController::class, 'account'])->name('account');
        Route::get('/history-order', [UserController::class, 'historyOrder'])->name('history-order');
        Route::get('/history-detail', [UserController::class, 'historyDetail'])->name('history-detail');
    });
?>
