<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\ShopifyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncShopifyProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync products from Shopify to the local database';

    protected $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        parent::__construct();
        $this->shopifyService = $shopifyService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $products = $this->shopifyService->getProducts();

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

            $this->info('Products synced successfully!');
        } catch (\Exception $e) {
            Log::error('Error syncing Shopify products: ' . $e->getMessage());
            $this->error('Failed to sync products: ' . $e->getMessage());
        }
    }
}
