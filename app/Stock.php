<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    protected $table = 'stock';

    protected $guarded = [];

    protected $casts = [
        'in_stock' => 'boolean',
    ];

    public function track()
    {
        if ($this->retailer->name === 'Best Buy') {
            // hit an API endpoint for the associated retailer
            // fetch the up-to-date details for the item
            $results = Http::get('http://foo.text')->json();

            // and then refresh the current stock record
            $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price'],
            ]);
        }
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}