<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Model\Admin\Category;
use App\Model\Admin\SubCategory;
use App\Model\Admin\Product;

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
        $main_slider = $this->product->select('products.*', 'brands.brand_name')
                                     ->join('brands', 'products.brand_id', '=', 'brands.id')
                                     ->where('main_slider', 1)
                                     ->orderBy('id',  'DESC')
                                     ->first();

        $view->with([
            'categories' => $this->category->all(),
            'sub_categories' => $this->sub_category->all(),
            'main_slider' => $main_slider,
        ]);
    }
}
