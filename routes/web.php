<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [TestController::class, 'view']);
Route::get('/test1', [TestController::class, 'showTest1']);
Route::get('/test2', [TestController::class, 'showTest2']);
Route::get('/test3', [TestController::class, 'showTest3']);
Route::get('/test4', [TestController::class, 'showTest4']);
Route::post('/search', [TestController::class, 'search']);
Route::get('/product', [ProductController::class, 'view']);
Route::post('/add-product', [ProductController::class, 'add']);
Route::get('/category', [CategoryController::class, 'view']);
Route::post('/add-category', [CategoryController::class, 'add']);
