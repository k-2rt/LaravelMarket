<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_name'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category');
    }

    /**
     * Find a sub category with parent category
     *
     * @return void
     */
    public function findSubCategory($id)
    {
        return $this->with('category:id,category_name')->find($id);
    }
}
