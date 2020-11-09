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
        'create_user',
        'update_user',
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
        return $this->with('post_category')
                    ->get();
    }

    /**
     * Check exists artiucle image in storage
     *
     * @return void
     */
    public function getStorageArticleImageAttribute()
    {
        if (Storage::disk('s3')->exists($this->post_image)) {
            return true;
        }
        return false;
    }

    /**
     * Search articles by keyword
     *
     * @param String $keyword
     * @return Object
     */
    public function searchArticlesByKeyword($keyword): Object
    {
        return $this->where('post_title_ja', 'LIKE', '%' . $keyword . '%')
                    ->paginate(9);
    }
}
