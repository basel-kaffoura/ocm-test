<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Show the main products page (renders the Vue component)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
