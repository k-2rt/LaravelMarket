<?php

namespace App\Http\ViewComposers\Layouts;

use Illuminate\View\View;
use Session;

/**
 * Class AppComposer
 * @package App\Http\ViewComposers\Layouts
 */
class AppComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $language = Session()->get('lang');

        $view->with(compact([
            'language',
        ]));
    }
}
