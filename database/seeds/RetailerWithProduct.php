<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Retailer;
use App\Stock;

class RetailerWithProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);

        $bestBuy = Retailer::create(['name' => 'Best Buy']);

        $stock = new Stock([
            'price' => 10000,
            'url' => 'http://foo.com',
            'sku' => '6364253',
            'in_stock' => false
        ]);

        $bestBuy->addStock($switch, $stock);
    }
}
