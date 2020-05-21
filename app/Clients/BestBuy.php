<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;
use App\Stock;

class BestBuy implements Client
{
    public function checkAvailability(Stock $stock): StockStatus
    {
        $results = Http::get('http://foo.text')->json();

        return new StockStatus(
            $results['available'],
            $results['price']
        );
    }
}
