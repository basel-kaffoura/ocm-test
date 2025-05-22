<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// API Routes
Route::get('/products/fetch', [ProductController::class, 'fetchAndStore'])->name('products.fetch');
Route::get('/products', [ProductController::class, 'getProducts'])->name('products.get');
