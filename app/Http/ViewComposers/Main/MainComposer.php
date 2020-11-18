<?php

namespace App\Http\ViewComposers\Main;

use Illuminate\View\View;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Newsletter;

/**
 * Class MainComposer
 * @package App\Http\ViewComposers\Main
 */
class MainComposer
{
    protected $product;
    protected $category;
    protected $news_letter;

    public function __construct(Product $product, Category $category, Newsletter $news_letter)
    {
        $this->product = $product;
        $this->category = $category;
        $this->news_letter = $news_letter;
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
        $new_arraival_products = $this->product->getProductsByCategoryId($first_category->id);
        $second_arraival_products = $this->product->getProductsByCategoryId($second_category->id);
        $check_newsletter = $this->news_letter->checkUserNewsInfo();

        $view->with(compact([
            'best_rated_products',
            'categories',
            'first_category',
            'new_arraival_products',
            'second_category',
            'second_arraival_products',
            'check_newsletter',
        ]));
    }
}
