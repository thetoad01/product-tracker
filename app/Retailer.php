<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Facades\App\Clients\ClientFactory;

class Retailer extends Model
{
    protected $guarded = [];

    public function addStock(Product $product, Stock $stock)
    {
        $stock->product_id = $product->id;

        $this->stock()->save($stock);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function client()
    {
        return ClientFactory::make($this);
    }
}
