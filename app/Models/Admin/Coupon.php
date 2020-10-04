<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon', 'discount',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
