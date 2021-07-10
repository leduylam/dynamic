<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\MultiLanguageController;

Route::auth();
Route::group([
    'middleware' => 'locale',
], function () {
    Route::get('lang/{lang}', [MultiLanguageController::class,'index'])->name('index');
});

Route::group([
    'middleware' => 'auth',
    'as' => 'admin.',
], function () {
    // page home
    Route::get('/dashboard', [AdminController::class,'index'])->name('index');
    Route::get('/time_day',[AdminController::class,'timeDay'])->name('day');
    Route::get('/time_month',[AdminController::class,'timeMonth'])->name('month');
    Route::get('/time_year',[AdminController::class,'timeYear'])->name('year');
    // page admins
    Route::get('/list', [AdminController::class, 'listAdmin'])->name('list');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');

    Route::group([
        'prefix' => '{id}',
    ], function () {
        Route::get('/show', [AdminController::class, 'show'])->name('show');
        Route::get('/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/', [AdminController::class, 'update'])->name('update');
        Route::delete('/', [AdminController::class, 'destroy'])->name('destroy');
    });

    //page product
    Route::group([
        'prefix' => 'product',
        'as' => 'product.',
    ], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::post('/import',[ProductController::class,'import'])->name('import');

        Route::group([
            'prefix' => '{id}',
        ], function () {
            Route::get('/show', [ProductController::class, 'show'])->name('show');
            Route::get('/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/', [ProductController::class, 'update'])->name('update');
            Route::delete('/', [ProductController::class, 'destroy'])->name('destroy');

        });
    });

    //page category
    Route::group([
        'prefix' => 'category',
        'as' => 'category.',
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/list/mid', [CategoryController::class, 'listCategoryMid'])->name('list.mid');
        Route::get('/list/small', [CategoryController::class, 'listCategorySmall'])->name('list.small');
        Route::post('/', [CategoryController::class, 'store'])->name('store');

        Route::group([
            'prefix' =>'{id}',
        ], function () {
            Route::get('/show', [CategoryController::class, 'show'])->name('show');
            Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');

            // category mid
            Route::get('/create', [CategoryController::class, 'createMid'])->name('create.mid');
            Route::get('/mid/show', [CategoryController::class, 'showMid'])->name('show.mid');
            Route::post('/mid', [CategoryController::class, 'storeMid'])->name('store.mid');
            Route::get('/mid/edit', [CategoryController::class, 'editMid'])->name('edit.mid');

            // category small
            Route::get('/small/create', [CategoryController::class, 'createSmall'])->name('create.small');
            Route::get('/small/show', [CategoryController::class, 'showSmall'])->name('show.small');
            Route::post('/small', [CategoryController::class, 'storeSmall'])->name('store.small');
            Route::get('/small/edit', [CategoryController::class, 'editSmall'])->name('edit.small');

            // method update, destroy
            Route::put('/mid', [CategoryController::class, 'updateMid'])->name('update.mid');
            Route::put('/small', [CategoryController::class, 'updateSmall'])->name('update.small');
            Route::put('/', [CategoryController::class, 'update'])->name('update');
            Route::delete('/', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });

    // page size
    Route::group([
        'prefix' => 'size',
        'as' => 'size.'
    ], function () {
        Route::get('/', [SizeController::class, 'index'])->name('index');
        Route::get('/create', [SizeController::class, 'create'])->name('create');
        Route::post('/', [SizeController::class, 'store'])->name('store');
        Route::group([
            'prefix' => '{id}',
        ], function () {
            Route::get('/edit', [SizeController::class, 'edit'])->name('edit');
            Route::put('/', [SizeController::class, 'update'])->name('update');
            Route::delete('/', [SizeController::class, 'destroy'])->name('destroy');
        });
    });

    // page color
    Route::group([
        'prefix' => 'color',
        'as' => 'color.'
    ], function () {
        Route::get('/', [ColorController::class, 'index'])->name('index');
        Route::get('/create', [ColorController::class, 'create'])->name('create');
        Route::post('/', [ColorController::class, 'store'])->name('store');
        Route::group([
            'prefix' => '{id}',
        ], function () {
            Route::get('/edit', [ColorController::class, 'edit'])->name('edit');
            Route::put('/', [ColorController::class, 'update'])->name('update');
            Route::delete('/', [ColorController::class, 'destroy'])->name('destroy');
        });
    });

    // page Order
    Route::group([
        'prefix' => 'order',
        'as' => 'order.'
    ], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/customer', [OrderController::class, 'customer'])->name('customer');
        Route::get('/product', [OrderController::class, 'product'])->name('product');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::group([
            'prefix' => '{id}',
        ], function () {
            Route::get('/edit', [OrderController::class, 'edit'])->name('edit');
            Route::put('/', [OrderController::class, 'update'])->name('update');
            Route::delete('/', [OrderController::class, 'destroy'])->name('destroy');
        });
    });

    // page báo cáo
    Route::group([
        'prefix' => 'report',
        'as' => 'report.'
    ], function () {
        Route::group([
            'prefix' => 'customer-report',
            'as' => 'customer-report.'
        ], function(){
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::get('/show/{id}', [ReportController::class, 'show'])->name('show');
        });
        Route::group([
            'prefix' => 'category-report',
            'as' => 'category-report.'
        ], function(){
            Route::get('/', [ReportController::class, 'categoryReport'])->name('index');
            Route::get('/show/{id}', [ReportController::class, 'showCategoryReport'])->name('show');
        });
        Route::group([
            'prefix' => 'detailed-report',
            'as' => 'detailed-report.'
        ], function(){
            Route::get('/', [ReportController::class, 'detailedReport'])->name('index');
        });
    });

    Route::group([
        'prefix' => 'stock',
        'as' => 'stock.'
    ], function () {
        Route::get('/', [StockController::class, 'index'])->name('index');
        Route::put('/{id}', [StockController::class, 'update'])->name('update');
        Route::delete('/{id}', [StockController::class, 'destroy'])->name('destroy');
    });
});
?>
