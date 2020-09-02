<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_code',
        'product_quantity',
        'category_id',
        'subcategory_id',
        'brand_id',
        'product_size',
        'product_color',
        'selling_price',
        'product_details',
        'video_link',
        'image_one',
        'image_two',
        'image_three',
        'main_slider',
        'hot_deal',
        'best_rated',
        'trend',
        'mid_slider',
        'hot_new',
        'status',
        'discount_price',
    ];
}
