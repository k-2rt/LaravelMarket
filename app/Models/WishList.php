<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $fillable = [
        'user_id', 'product_id'
    ];

    public function getWishListsByUserId($userId) {
        return $this->where('user_id', $userId)->get();
    }
}
