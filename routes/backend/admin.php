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

    // page admins
    Route::get('/list', [AdminController::class, 'listAdmin'])->name('list');
    Route::get('/create', [AdminController::class, 'create'])->name('create');

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
    });

    //page category
    Route::group([
        'prefix' => 'category',
        'as' => 'category.',
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');

        Route::group([
            'prefix' =>'{id}',
        ], function () {
            Route::get('/show', [CategoryController::class, 'show'])->name('show');
            Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::get('/create', [CategoryController::class, 'createMid'])->name('create.mid');
            Route::get('/mid/show', [CategoryController::class, 'showMid'])->name('show.mid');
            Route::post('/mid', [CategoryController::class, 'storeMid'])->name('store.mid');
            Route::get('/mid/edit', [CategoryController::class, 'editMid'])->name('edit.mid');
            Route::put('/mid', [CategoryController::class, 'updateMid'])->name('update.mid');
            Route::put('/', [CategoryController::class, 'update'])->name('update');
            Route::delete('/', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });
});
?>
