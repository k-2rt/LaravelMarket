<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SiteSetting;

class SiteSettingController extends Controller
{
    protected $site_set;

    public function __construct(SiteSetting $site_set)
    {
        $this->site_set = $site_set;
    }

    /**
     * Show site setting page
     *
     * @return void
     */
    public function showSiteSetting()
    {
        $setting = $this->site_set->first();

        return view('admin.setting.site_setting', compact('setting'));
    }

    /**
     * Update Site setting
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateSiteSetting(Request $request, $id)
    {
        $this->site_set->find($id)->update($request->all());

        $notification = array(
            'message' => '更新しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
