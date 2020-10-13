<?php

namespace App\Http\ViewComposers\Main;

use Illuminate\View\View;
use App\Models\Admin\Product;
use App\Models\Admin\Category;

/**
 * Class MainComposer
 * @package App\Http\ViewComposers\Main
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


        $best_rated_products = $this->product->getBestRatedProducts();

        $mid_slider_products = $this->product->getMiddleSliderProducts();
        $new_arraival_products = $this->product->getProductsByCategoryId($first_category->id);
        $second_arraival_products = $this->product->getProductsByCategoryId($second_category->id);

        $view->with(compact([
            'best_rated_products',
            'categories',
            'mid_slider_products',
            'first_category',
            'new_arraival_products',
            'second_category',
            'second_arraival_products',
        ]));
    }
}
