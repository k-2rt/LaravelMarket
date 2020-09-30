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

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * Get prefecture name
     *
     * @return String
     */
    public function getPrefNameAttribute(): String
    {
        return config('pref.' . $this->ship_prefectures);
    }

    /**
     * Configure zip code
     *
     * @return String
     */
    public function getConfigureZipAttribute(): String
    {
        return substr($this->ship_zip_code, 0, 3) . ' - ' . substr($this->ship_zip_code, 3);
    }
}
