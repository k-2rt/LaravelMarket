<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_name'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }
}
