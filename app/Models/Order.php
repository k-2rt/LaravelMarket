<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_id',
        'payment_type',
        'balance_transaction',
        'stripe_order_id',
        'shipping_fee',
        'discount',
        'total',
        'subtotal',
        'status',
        'order_date',
    ];

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function shipping()
    {
        return $this->hasMany('App\Models\Shipping');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Delimiter price with comma
     *
     * @return String
     */
    public function getTotalDelimiterAttribute(): String
    {
        return number_format($this->total);
    }
}
