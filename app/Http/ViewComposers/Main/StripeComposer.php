<?php

namespace App\Http\ViewComposers\Main;

use Illuminate\View\View;

/**
 * Class StripeComposer
 * @package App\Http\ViewComposers\Main
 */
class StripeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $stripe = config('app.stripe_api');

        $view->with(compact([
            'stripe',
        ]));
    }
}
