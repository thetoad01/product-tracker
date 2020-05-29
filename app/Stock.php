<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UseCases\TrackStock;

class Stock extends Model
{
    protected $table = 'stock';

    protected $guarded = [];

    protected $casts = [
        'in_stock' => 'boolean',
    ];

    public function track()
    {
        dispatch(new TrackStock($this));
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
