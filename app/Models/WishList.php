<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $fillable = [
        'user_id', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product');
    }

    public function getWishListsByUserId($userId)
    {
        return $this->where('user_id', $userId)->get();
    }

    /**
     * Get products of wish lists
     *
     * @param String $userId
     * @return Object
     */
    public function getWishListsWithProduct($userId)
    {
        return $this->with('product')->where('user_id', $userId)
                                     ->orderBy('id', 'DESC')
                                     ->get();
    }
}
