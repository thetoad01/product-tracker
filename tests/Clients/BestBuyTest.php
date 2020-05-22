<?php

namespace Tests\Clients;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $stock = tap(Stock::first())->update([
            'sku' => '6364253',  // Nintendo Switch sku
            'url' => 'https://www.bestbuy.com/site/nintendo-switch-32gb-console-gray-joy-con/6364253.p?skuId=6364253',
        ]);

        try {
            $stockStatus = (new BestBuy())->checkAvailability($stock);
        } catch (\Exception $e) {
            $this->fail('Failed to track the Best Buy API properly.');
        }

        $this->assertTrue(true);
    }
}
