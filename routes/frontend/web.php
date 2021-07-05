<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dynamic\DynamicSportController;
use App\Http\Controllers\Dynamic\ProductController;
use App\Http\Controllers\Dynamic\LoginController;


    Route::get('/', [DynamicSportController::class, 'home'])->name('welcome');
    Route::group([
        'prefix' => 'customer',
        'as' => 'customer.',
    ], function(){
        Route::get('/', [LoginController::class, 'login'])->name('login');
    });
    Route::group([
        'prefix' => 'product',
        'as' => 'product.'
    ], function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{name}', [ProductController::class, 'listing']);
        
        
        Route::get('product-table/', [ProductController::class, 'tableProduct'])->name('product-table');
        Route::get('/product-detail/{id}', [ProductController::class, 'productDetail'])->name('product-detail');
    });

?>
