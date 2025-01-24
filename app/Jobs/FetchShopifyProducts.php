<?php

namespace App\Jobs;

use App\Services\ShopifyService;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchShopifyProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */

    public $tries = 2;

    public function handle()
    {
        $shopifyService = new ShopifyService();

        try {
            $products = $shopifyService->getProducts();

            foreach ($products as $product) {
                Product::updateOrCreate(
                    ['shopify_id' => $product['id']],
                    [
                        'title' => $product['title'],
                        'price' => $product['variants'][0]['price'],
                        'inventory' => $product['variants'][0]['inventory_quantity'],
                    ]
                );
            }
        } catch (\Exception $e) {
            Log::error('Error fetching Shopify products: ' . $e->getMessage());
        }
    }
}