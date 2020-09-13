<?php

namespace App\Models\Admin;

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
        'buyone_getone',
        'best_rated',
        'trend',
        'mid_slider',
        'hot_new',
        'status',
        'discount_price',
    ];

    /**
     * Get a latest product that main slider status is 1
     *
     * @return Object
     */
    public function getFirstMainSliderProduct() {
        return Product::select('products.*', 'brands.brand_name')
                    ->join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where('main_slider', 1)
                    ->orderBy('id',  'DESC')
                    ->first();
    }

    /**
     * Get products that status is 1
     *
     * @return Object
     */
    public function getActiveProducts() {
        return Product::where('status', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();
    }

    /**
     * Get products that trend is 1
     *
     * @return Object
     */
    public function getTrendProducts() {
        return Product::where('status', 1)
                    ->where('trend', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();
    }

    /**
     * Get products that best rated is 1
     *
     * @return Object
     */
    public function getBestRatedProducts() {
        return Product::where('status', 1)
                    ->where('best_rated', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();
    }

    /**
     * Caluculate discount percentage
     *
     * @return Int
     */
    public function caluculateDiscountPercent() {
        $amount = $this->selling_price - $this->discount_price;
        return round($amount / $this->selling_price * 100);
    }

    /**
     * Get hot deal products
     *
     * @return Object
     */
    public function getHotDealProducts() {
        return Product::select('products.*', 'brands.brand_name')
                    ->where('hot_deal', 1)
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }

    public function getMiddleSliderProducts() {
        return Product::select('products.*', 'categories.category_name', 'brands.brand_name')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->where('products.mid_slider', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }
}
