<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $guarded = [];

    protected $casts = [
        'in_stock' => 'boolean',
    ];

    public function track()
    {
        $status = $this->retailer
            ->client()
            ->checkAvailability($this);

        // update database
        $this->update([
            'in_stock' => $status->available,
            'price' => $status->price,
        ]);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
