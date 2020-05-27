<?php

namespace Tests\Unit;

use App\Clients\StockStatus;
use App\History;
use App\Product;
use Facades\App\Clients\ClientFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use RetailerWithProduct;

class ProductHistoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_records_history_each_time_stock_is_tracked()
    {
        $this->seed(RetailerWithProduct::class);

        ClientFactory::shouldReceive('make->checkAvailability')
            ->andReturn(new StockStatus($available = true, $price = 99));

        $this->assertEquals(0, History::count());

        $product = tap(Product::first())->track();

        $this->assertEquals(1, History::count());

        $history = History::first();
        $stock = $product->stock[0];

        $this->assertEquals($price, $history->price);
        $this->assertEquals($available, $history->in_stock);
        $this->assertEquals($stock->product_id, $history->product_id);
        $this->assertEquals($stock->id, $history->stock_id);
    }
}
