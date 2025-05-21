<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// API Routes
Route::get('/api/products/fetch', [ProductController::class, 'fetchAndStore'])->name('products.fetch');
