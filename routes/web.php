<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopifyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/shopify-products', [ShopifyController::class, 'getProductsFromApi']);

Route::get('/products', [ProductController::class, 'index']);

