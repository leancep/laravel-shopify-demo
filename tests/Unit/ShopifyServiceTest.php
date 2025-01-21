<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ShopifyService;
use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class ShopifyServiceTest extends TestCase
{
    public function test_that_fetches_products_successfully()
    {
        $mockClient = Mockery::mock(Client::class);
        $mockClient->shouldReceive('get')
            ->once()
            ->with('products.json')
            ->andReturn(new \GuzzleHttp\Psr7\Response(200, [], json_encode([
                'products' => [
                    ['id' => 1, 'title' => 'Playstation 5', 'variants' => [['price' => 500, 'inventory_quantity' => 10]]],
                    ['id' => 2, 'title' => 'IPhone 16', 'variants' => [['price' => 1300, 'inventory_quantity' => 5]]],
                ],
            ])));

        $service = new ShopifyService();
        $service->setClient($mockClient);
        $products = $service->getProducts();

        $this->assertCount(2, $products);
        $this->assertEquals('Playstation 5', $products[0]['title']);
        $this->assertEquals(500, $products[0]['variants'][0]['price']);
        $this->assertEquals(10, $products[0]['variants'][0]['inventory_quantity']);
    }
}