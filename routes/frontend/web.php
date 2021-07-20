<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dynamic\DynamicSportController;
use App\Http\Controllers\Dynamic\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dynamic\UserController;
use App\Http\Controllers\Dynamic\ProductController;

    Route::group([
        'prefix' => 'customer',
        'as' => 'customer.',
    ], function () {
        Route::get('/', [LoginController::class, 'showUserLoginForm'])->name('login');
        Route::post('/', [LoginController::class, 'userLogin'])->name('login.success');
    });

    Route::group([
        ['middleware' => ['auth']],
    ], function () {
        Route::get('/', [DynamicSportController::class, 'home'])->name('welcome');

        Route::group([
            'prefix' => 'product',
            'as' => 'product.'
        ], function () {
            Route::get('/item/{id}', [ProductController::class, 'showItem'])->name('item.show');
            Route::get('/check-stock', [ProductController::class, 'checkStock'])->name('item.stock');
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/product-table', [ProductController::class, 'tableProduct'])->name('product-table');
            Route::get('/product-detail/{id}', [ProductController::class, 'productDetail'])->name('product-detail');
            Route::get('/add-to-card', [ProductController::class, 'addtoCard'])->name('add-to-card');
        });

        Route::group([
            'prefix' => 'cart',
            'as' => 'cart.'
        ], function(){
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
            Route::post('/add', [OrderController::class, 'store'])->name('store');
        });

        Route::group([
            'prefix' => 'user',
            'as' => 'user.',
        ], function () {
            Route::get('/account', [UserController::class, 'account'])->name('account');
            Route::get('/history-order', [UserController::class, 'historyOrder'])->name('history-order');
            Route::get('/history-detail/{id}', [UserController::class, 'historyDetail'])->name('history-detail');
            Route::post('/detail', [UserController::class, 'detail'])->name('detail');
            Route::post('/change-password', [UserController::class, 'changePassword'])->name('change-password');
        });
    });
?>
