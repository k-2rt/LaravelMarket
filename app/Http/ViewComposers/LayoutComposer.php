<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Product;

/**
 * Class LayoutComposer
 * @package App\Http\ViewComposers
 */
class LayoutComposer
{
    protected $category;
    protected $sub_category;
    protected $product;

    public function __construct(Category $category, SubCategory $sub_category, Product $product)
    {
        $this->category = $category;
        $this->sub_category = $sub_category;
        $this->product = $product;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $main_slider = $this->product->getFirstMainSliderProduct();

        $view->with([
            'categories' => $this->category->all(),
            'sub_categories' => $this->sub_category->all(),
            'main_slider' => $main_slider,
        ]);
    }
}
