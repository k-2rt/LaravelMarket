<?php

namespace App\Http\ViewComposers\Auth;

use Illuminate\View\View;

/**
 * Class CheckoutComposer
 * @package App\Http\ViewComposers\Auth
 */
class LoginComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $prefs = config('pref');

        $view->with(compact([
            'prefs',
        ]));
    }
}
