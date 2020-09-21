<?php

namespace App\Http\ViewComposers\Main;

use Illuminate\View\View;
use App\Models\OrderSetting;

/**
 * Class CheckoutComposer
 * @package App\Http\Main\ViewComposers
 */
class CheckoutComposer
{
    protected $order_setting;

    public function __construct(OrderSetting $order_setting)
    {
        $this->order_setting = $order_setting;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $setting = $this->order_setting->first();
        $shipping_fee = $setting->shipping_fee;

        $view->with(compact([
            'shipping_fee',
        ]));
    }
}
