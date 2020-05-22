<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use RetailerWithProduct;
use App\Clients\Client;
use App\Clients\ClientException;
use App\Clients\StockStatus;
use Facades\App\Clients\ClientFactory;
use App\Retailer;
use App\Stock;

class StockTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_throws_an_exception_if_a_client_is_not_found_when_tracking()
    {
        // GIVEN I have a retailer with stock
        $this->seed(RetailerWithProduct::class);

        Retailer::first()->update(['name' => 'Foo Retailer']);

        // THEN an exception should be thrown if no Client
        $this->expectException(ClientException::class);

        // IF I track that stock
        Stock::first()->track();
    }

    /** @test */
    function it_updates_local_status_after_being_tracked()
    {
        $this->seed(RetailerWithProduct::class);

        ClientFactory::shouldReceive('make')->andReturn(new class implements Client
            {
                public function checkAvailability(Stock $stock): StockStatus
                {
                    return new StockStatus($available = true, $price = 9900);
                }
            }
        );

        $stock = tap(Stock::first())->track();

        $this->assertTrue($stock->in_stock);
        $this->assertEquals(9900, $stock->price);
    }
}
