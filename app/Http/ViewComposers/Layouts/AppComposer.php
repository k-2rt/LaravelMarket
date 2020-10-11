<?php

namespace App\Http\ViewComposers\Layouts;

use Illuminate\View\View;
use Session;
use App\Models\Admin\SiteSetting;

/**
 * Class AppComposer
 * @package App\Http\ViewComposers\Layouts
 */
class AppComposer
{
    protected $site_set;

    public function __construct(SiteSetting $site_set)
    {
        $this->site_set = $site_set;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $language = Session()->get('lang');
        $site = $this->site_set->first();

        $view->with(compact([
            'language',
            'site',
        ]));
    }
}
