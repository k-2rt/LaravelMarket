<?php

namespace App\Http\ViewComposers\Main;

use Illuminate\View\View;
use App\Models\Admin\Category;

/**
 * Class ProductListComposer
 * @package App\Http\Main\ViewComposers
 */
class ProductListComposer
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $categories = $this->category->get();

        $view->with(compact([
            'categories',
        ]));
    }
}
