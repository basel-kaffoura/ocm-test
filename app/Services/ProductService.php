<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected string $apiUrl = 'https://fakestoreapi.com/products';

    /**
     * Fetch products from API and store them in the DB
     */
    public function fetchAndStoreProducts()
    {
        // Attempt to fetch data from API and handle errors
        try {
            // Fetch products from API
            $response = Http::get($this->apiUrl);

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

                return [
                    'success' => true,
                    'message' => count($products) . ' product' . (count($products) > 1 ? 's' : '') . ' successfully fetched and stored.',
                    'count' => count($products)
                ];
            } else {
                Log::error('Failed to fetch products from API: ' . $response->status());
                return [
                    'success' => false,
                    'message' => 'Failed to fetch products. Status code: ' . $response->status()
                ];
            }
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching products: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Search for products (based on title, description or category)
     */
    public function searchProducts($search = null) {
        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        return $query->get();
    }
}
