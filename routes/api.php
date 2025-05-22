<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// API Routes

// Fetch products from external API and store them in the DB
Route::get('/products/fetch', [ProductController::class, 'fetchAndStore'])->name('products.fetch');

// Retrieve products from the DB
Route::get('/products', [ProductController::class, 'getProducts'])->name('products.get');
