<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $quantity = $request->query('quantity', 10);
            $products = Product::paginate($quantity);
            return response()->json([
                'status' => 'success',
                'data' => $products->items(),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'per_page' => (int)$quantity,
                    'total_pages' => $products->lastPage(),
                    'total_items' => $products->total(),
                   
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
