<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'post_title_en',
        'post_title_ja',
        'details_en',
        'details_ja',
        'post_image',
    ];
}
