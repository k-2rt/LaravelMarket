<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    protected $table = 'seo';

    protected $fillable = [
        'meta_title',
        'meta_author',
        'meta_tag',
        'meta_description',
        'google_analytics',
        'bing_analytics',
    ];
}
