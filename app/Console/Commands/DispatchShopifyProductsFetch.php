<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FetchShopifyProducts;

class DispatchShopifyProductsFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:fetch-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch a job to fetch products from Shopify';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FetchShopifyProducts::dispatch();

        $this->info('Job to fetch Shopify products has been dispatched.');
        return 0;
    }
}
