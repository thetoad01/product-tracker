<?php

namespace Tests\Clients;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use RetailerWithProduct;
use App\Stock;
use App\Clients\BestBuy;

/**
 * @group api
 */
class BestBuyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tracks_a_product()
    {
        $this->seed(RetailerWithProduct::class);

        $stock = Stock::first();
        $stock->update([
            'sku' => '6364253', // Nintendo Switch sku
            'url' => 'https://www.bestbuy.com/site/nintendo-switch-32gb-console-gray-joy-con/6364253.p?skuId=6364253'
        ]);

        try {
            (new BestBuy())->checkAvailability($stock);
        } catch (\Exception $e) {
            $this->fail('Failed to track the BestBuy API properly.');
        }

        $this->assertTrue(true);
    }

    /** @test */
    function it_creates_the_proper_stock_status_resonse()
    {
        Http::fake(function() {
            return [
                'salePrice' => 299.99,
                'onlineAvailability' => true,
            ];
        });

        $stockStatus = (new BestBuy())->checkAvailability(new Stock);

        $this->assertEquals(29999, $stockStatus->price);
        $this->assertTrue($stockStatus->available);
    }
}
