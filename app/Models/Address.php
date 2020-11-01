<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'zip_code', 'prefectures', 'address1', 'address2',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
