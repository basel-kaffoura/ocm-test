<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{

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
        $apiUrl = 'https://fakestoreapi.com/products';
        // Fetch products from API
        $response = Http::get($apiUrl);

        // Check if the API response returned a successful status
        if ($response->successful()) {
            $products = $response->json();

            // Store each product in the DB
            foreach ($products as $productData) {
                Product::updateOrCreate(
                    ['id' => $productData['id']],
                    [
                        'title' => $productData['title'],
                        'price' => $productData['price'],
                        'description' => $productData['description'],
                        'category' => $productData['category'],
                        'image' => $productData['image'],
                        'rating_rate' => $productData['rating']['rate'] ?? null,
                        'rating_count' => $productData['rating']['count'] ?? null,
                    ]
                );
            }

            $result = [
                'success' => true,
                'message' => count($products) . ' product' . (count($products) > 1 ? 's' : '') . ' successfully fetched and stored.',
                'count' => count($products)
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Failed to fetch products. Status code: ' . $response->status()
            ];
        }

        return response()->json($result);
    }
}
