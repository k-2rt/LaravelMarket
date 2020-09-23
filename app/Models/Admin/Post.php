<?php

namespace App\Models\Admin;

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

    /**
     * Get posts with post categories
     *
     * @return Object
     */
    public function getPostsWithPostCategories() {
        return $this->select('posts.*', 'post_categories.category_name_en', 'post_categories.category_name_ja')
                    ->join('post_categories', 'posts.category_id', 'post_categories.id')
                    ->get();
    }
}
