<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->group(function () {
    Route::get('/store', [StoreController::class, 'index']);
    Route::post('/create-store', [StoreController::class, 'create']);
    Route::get('/store/{id}', [StoreController::class, 'detail']);
    Route::post('/update-store/{id}', [StoreController::class, 'update']);
    Route::delete('/delete-store/{id}', [StoreController::class, 'delete']);
    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/create-product', [ProductController::class, 'create']);
    Route::get('/product/{id}', [ProductController::class, 'detail']);
    Route::post('/update-product/{id}', [ProductController::class, 'update']);
    Route::delete('/delete-product/{id}', [ProductController::class, 'delete']);
});
