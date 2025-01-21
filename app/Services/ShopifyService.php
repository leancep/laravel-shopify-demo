<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class ShopifyService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://' . env('SHOPIFY_SHOP_DOMAIN') . '/admin/api/2025-01/',
            'headers' => [
                'X-Shopify-Access-Token' => env('SHOPIFY_ACCESS_TOKEN'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getProducts()
    {
        try {
            $response = $this->client->get('products.json');
            return json_decode($response->getBody()->getContents(), true)['products'];
        } catch (Exception $e) {
            throw new Exception("Shopify API error: " . $e->getMessage());
        }
    }




    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
