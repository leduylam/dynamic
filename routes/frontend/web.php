<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dynamic\DynamicSportController;
use App\Http\Controllers\Dynamic\ProductController;


    Route::get('/', [DynamicSportController::class, 'home'])->name('welcome');
    

    Route::group([
        'prefix' => 'product',
        'as' => 'product.'
    ], function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');

        Route::get('product-table', [ProductController::class, 'tableProduct'])->name('product-table');
        Route::get('/product-detail', [ProductController::class, 'productDetail'])->name('product-detail');
    });

?>
