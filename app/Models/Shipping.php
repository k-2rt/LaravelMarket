<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping';

    protected $fillable = [
        'order_id',
        'ship_name',
        'ship_phone',
        'ship_email',
        'ship_zip_code',
        'ship_prefectures',
        'ship_address1',
        'ship_address2',
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
}
