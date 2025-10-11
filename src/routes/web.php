<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/products', [ProductController::class, 'index']);

// 商品更新
Route::post('/products/{productId}/update', [ProductController::class, 'update']);


Route::get('/products/register', [ProductController::class, 'create']);
Route::post('/products/register', [ProductController::class, 'store']);


Route::get('/products/search', [ProductController::class, 'search']);
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy']);
