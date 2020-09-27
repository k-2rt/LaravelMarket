<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'color',
        'size',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
}
