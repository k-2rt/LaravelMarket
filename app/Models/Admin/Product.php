<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Brand;

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

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Admin\Brand');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Admin\SubCategory');
    }

    /**
     * Get a latest product that main slider status is 1
     *
     * @return Object
     */
    public function getFirstMainSliderProduct() {
        return $this->select('products.*', 'brands.brand_name')
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
        return $this->where('status', 1)
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
        return $this->where('status', 1)
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
        return $this->where('status', 1)
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
     * Get hot deal products with brand name
     *
     * @return Object
     */
    public function getHotDealProducts() {
        return $this->select('products.*', 'brands.brand_name')
                    ->where('hot_deal', 1)
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }

    /**
     * Get products to show at middle slider with category & brand name
     *
     * @return Object
     */
    public function getMiddleSliderProducts() {
        return $this->select('products.*', 'categories.category_name', 'brands.brand_name')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->where('products.mid_slider', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }

    /**
     * Get products by category id
     *
     * @param String $id
     * @return Object
     */
    public function getProductsByCategoryId($id) {
        return $this->where('category_id', $id)
                    ->where('status', 1)
                    ->limit(10)
                    ->orderBy('id', 'DESC')
                    ->get();
    }

    public function getBuyoneGetoneProducts() {
        return  $this->select('products.*', 'brands.brand_name')
                     ->join('brands', 'products.brand_id', 'brands.id')
                     ->where('status', 1)->where('buyone_getone', 1)
                     ->orderBy('id', 'DESC')
                     ->limit(6)
                     ->get();
    }

    /**
     * Get info of a product to show modal view
     *
     * @param String $id
     * @return Object
     */
    public function getProductToDisplayInfo($id) {
        return $this->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->where('products.id', $id)
                    ->first();
    }

    /**
     * Configure to save product info to cart
     *
     * @param String $id
     * @return Array
     */
    public function configureProductInfo($id) {
        $product = $this->where('id', $id)->first();

        $data = array();
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = 1;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        $data['options']['color'] = '';
        $data['options']['size'] = '';

        if ($product->discount_price === NULL) {
            $data['price'] = $product->selling_price;
        } else {
            $data['price'] = $product->discount_price;
        }

        return $data;
    }

    /**
     * Get products with wish lists
     *
     * @return Object
     */
    public function getProductsWithWishLists($user_id) {
        return $this->select('products.*', 'wish_lists.user_id')
                    ->join('wish_lists', 'products.id', 'wish_lists.product_id')
                    ->where('wish_lists.user_id', $user_id)
                    ->get();
    }

    /**
     * Get paginate categories
     *
     * @param String $id
     * @return Object
     */
    public function getPaginateCategories($id) {
        return $this->where('category_id', $id)->paginate(5);
    }

    /**
     * Get paginate products
     *
     * @param String $id
     * @return Object
     */
    public function getPaginateProducts($id) {
        return $this->where('subcategory_id', $id)->paginate(1);
    }

    /**
     * Get brands by category id
     *
     * @param String $id
     * @return Array
     */
    public function getBrandsByCategoryId($id) {
        $brnad_ids = $this->select('brand_id')->where('category_id', $id)->groupBy('brand_id')->get();
        $brands = [];
        foreach ($brnad_ids as $brand) {
            $brands[] = Brand::where('id', $brand->brand_id)->first();
        }

        return $brands;
    }

    /**
     * Get brands by sub category id
     *
     * @param String $id
     * @return Array
     */
    public function getBrandsBySubCategoryId($id) {
        $brnad_ids = $this->select('brand_id')->where('subcategory_id', $id)->groupBy('brand_id')->get();
        $brands = [];
        foreach ($brnad_ids as $brand) {
            $brands[] = Brand::where('id', $brand->brand_id)->first();
        }

        return $brands;
    }

    public function countAllProducts()
    {
        return $this->all()->count();
    }

}
