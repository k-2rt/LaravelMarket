<?php

namespace App\Http\ViewComposers\Main;

use Illuminate\View\View;
use App\Models\Admin\Product;
use App\Models\Admin\Category;

/**
 * Class MainComposer
 * @package App\Http\Main\ViewComposers
 */
class MainComposer
{
    protected $product;
    protected $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $categories = $this->category->getAllCategories();
        $first_category = $this->category->getFirstCategory();
        $second_category = $this->category->getSecondCategory();

        $active_products = $this->product->getActiveProducts();
        $trend_products = $this->product->getTrendProducts();
        $best_rated_products = $this->product->getBestRatedProducts();
        $hot_deal_products = $this->product->getHotDealProducts();
        $mid_slider_products = $this->product->getMiddleSliderProducts();
        $new_arraival_products = $this->product->getProductsByCategoryId($first_category->id);
        $second_arraival_products = $this->product->getProductsByCategoryId($second_category->id);
        $buyone_getone_products = $this->product->getBuyoneGetoneProducts();

        $view->with(compact([
            'active_products',
            'trend_products',
            'best_rated_products',
            'hot_deal_products',
            'categories',
            'mid_slider_products',
            'first_category',
            'new_arraival_products',
            'second_category',
            'second_arraival_products',
            'buyone_getone_products',
        ]));
    }
}
