<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_tracks_product_stock()
    {
        Mail::fake();
        
        $this->seed(RetailerWithProductSeeder::class);

        $this->assertFalse(Product::first()->inStock());

        $this->mockClientRequest();

        $this->artisan('track');

        $this->assertTrue(Product::first()->inStock());
    }
}