<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Admin\Subcategory');
    }

    /**
     * Get all products
     *
     * @return Object
     */
    public function getAllCategories()
    {
        return $this->all();
    }

    /**
     * Get first category
     *
     * @return Object
     */
    public function getFirstCategory()
    {
        return $this->first();
    }

    /**
     * Get second category
     *
     * @return void
     */
    public function getSecondCategory()
    {
        return $this->skip(1)->first();
    }

    /**
     * Find a category
     *
     * @return void
     */
    public function findCategory($id)
    {
        return $this->find($id);
    }
}
