<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'comment_text',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongnsTo('App\Models\Admin\Product');
    }

    /**
     * Get comments of product with user by product id
     *
     * @param String $id
     * @return Array
     */
    public function getProductCommentsById($id)
    {
        return $this->with('user')->where('product_id', '=', $id)->orderBy('id', 'DESC')->get();
    }

    /**
     * Getter to created at format
     *
     * @return void
     */
    protected function getCommentCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y年m月d日');
    }
}
