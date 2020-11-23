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
        'coupon_id',
        'discount',
        'total',
        'subtotal',
        'status',
        'status_code',
        'order_date',
        'delivery_date',
        'delivery_time',
    ];

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function shipping()
    {
        return $this->hasMany('App\Models\Shipping');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Admin\Coupon');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Delimiter sub total price with comma
     *
     * @return String
     */
    public function getSubTotalDelimiterAttribute(): String
    {
        return number_format($this->subtotal);
    }

    /**
     * Delimiter total price with comma
     *
     * @return String
     */
    public function getTotalDelimiterAttribute(): String
    {
        return number_format($this->total);
    }

    /**
     * Delimiter discount price with comma
     *
     * @return String
     */
    public function getDiscountDelimiterAttribute(): String
    {
        return number_format($this->discount);
    }

    /**
     * Show delivery date with day of week
     *
     * @return String
     */
    public function getDayOfWeekAttribute(): String
    {
        $date = config('delivery');

        return $this->delivery_date . ' (' . $date['week'][date("w", strtotime($this->delivery_date))] . ')';
    }
}
