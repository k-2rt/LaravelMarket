<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name', 'brand_logo'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public function countAllBrands()
    {
        return $this->all()->count();
    }
}
