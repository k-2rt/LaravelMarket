<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'post_category_id',
        'post_title_en',
        'post_title_ja',
        'details_en',
        'details_ja',
        'post_image',
    ];

    public function post_category()
    {
        return $this->belongsTo('App\Models\Admin\PostCategory');
    }

    /**
     * Get posts with post categories
     *
     * @return Object
     */
    public function getPostsWithPostCategories()
    {
        return $this->select('posts.*', 'post_categories.category_name_en', 'post_categories.category_name_ja')
                    ->join('post_categories', 'posts.category_id', 'post_categories.id')
                    ->get();
    }

    /**
     * Check exists artiucle image in storage
     *
     * @return void
     */
    public function getStorageArticleImageAttribute()
    {
        $old_img = str_replace('storage/', 'public/', $this->post_image);
        if (Storage::exists($old_img)) {
            return true;
        } else {
            return false;
        }
    }
}
