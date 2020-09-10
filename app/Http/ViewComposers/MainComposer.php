<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Admin\Product;
use App\Models\Admin\Category;

/**
 * Class LayoutComposer
 * @package App\Http\ViewComposers
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
        $active_products = $this->product->getActiveProducts();
        $trend_products = $this->product->getTrendProducts();
        $best_rated_products = $this->product->getBestRatedProducts();
        $hot_deal_products = $this->product->getHotDealProducts();
        $hot_deal_products = $this->product->getHotDealProducts();
        $mid_slider_products = $this->product->getMiddleSliderProducts();

        $categories = $this->category->getAllCategories();

        $view->with([
            'active_products' => $active_products,
            'trend_products' => $trend_products,
            'best_rated_products' => $best_rated_products,
            'hot_deal_products' => $hot_deal_products,
            'categories' => $categories,
            'mid_slider_products' => $mid_slider_products,
        ]);
    }
}
