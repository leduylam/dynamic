<?php

use Illuminate\Support\Facades\Route;
//Admin Controller
use App\Http\Controllers\Admin\AdminController;

//Frontend Controller
use App\Http\Controllers\FrontEnd\FrontendController;

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

Route::get('/', [FrontendController::class, 'home']);


Route::prefix('/admin')->namespace('Admin')->group(function(){
    Route::get('/login', [AdminController::class, 'login']);
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});