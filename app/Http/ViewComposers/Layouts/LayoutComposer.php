<?php

namespace App\Http\ViewComposers\Layouts;

use Illuminate\View\View;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Product;
use App\Models\WishList;
use Auth;

/**
 * Class LayoutComposer
 * @package App\Http\ViewComposers\Layouts
 */
class LayoutComposer
{
    protected $category;
    protected $sub_category;
    protected $product;
    protected $wish_list;

    public function __construct(Category $category, SubCategory $sub_category, Product $product, WishList $wish_list)
    {
        $this->category = $category;
        $this->sub_category = $sub_category;
        $this->product = $product;
        $this->wish_list = $wish_list;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $main_slider = $this->product->getFirstMainSliderProduct();
        $wish_lists = $this->wish_list->getWishListsByUserId(Auth::id());

        $view->with([
            'categories' => $this->category->all(),
            'sub_categories' => $this->sub_category->all(),
            'main_slider' => $main_slider,
            'wish_lists' => $wish_lists,
        ]);
    }
}
