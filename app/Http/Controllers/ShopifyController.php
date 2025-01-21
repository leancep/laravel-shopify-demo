<?php

namespace App\Http\Controllers;

use App\Services\ShopifyService;
use Exception;

class ShopifyController extends Controller
{
    protected $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

    public function getProductsFromApi()
    {
        try {
            $products = $this->shopifyService->getProducts();
            return response()->json([
                'status' => 'success',
                'data' => $products,
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}