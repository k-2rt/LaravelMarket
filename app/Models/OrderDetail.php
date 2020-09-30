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

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product');
    }

    public function shipping()
    {
        return $this->hasMany('App\Models\Shipping');
    }

    /**
     * Delimiter unit price with comma and add 円
     *
     * @return String
     */
    public function getUnitDelimiterAttribute(): String
    {
        return number_format($this->unit_price) . '円';
    }

    /**
     * Delimiter total price with comma and add 円
     *
     * @return String
     */
    public function getTotalDelimiterAttribute(): String
    {
        return number_format($this->total_price) . '円';
    }
}
