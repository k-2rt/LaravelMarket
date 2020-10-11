<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'category_name_en',
        'category_name_ja',
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Admin\Post');
    }
}
