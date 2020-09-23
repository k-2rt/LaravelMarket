<?php

namespace App\Http\ViewComposers\Layouts;

use Illuminate\View\View;
use App\Models\Admin\Product;

/**
 * Class SliderComposer
 * @package App\Http\ViewComposers\Layouts
 */
class SliderComposer
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $main_slider = $this->product->getFirstMainSliderProduct();

        $view->with([
            'main_slider' => $main_slider,
        ]);
    }
}
