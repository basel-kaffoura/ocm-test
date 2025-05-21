<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Products page
     */
    public function index() {
        return view('products.index');
    }

    /**
     * Fetch products from API and store in the DB
     */
    public function fetchAndStore()
    {
        $result = $this->productService->fetchAndStoreProducts();
        return response()->json($result);
    }
}
