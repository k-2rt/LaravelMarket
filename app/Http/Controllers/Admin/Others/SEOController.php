<?php

namespace App\Http\Controllers\Admin\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SEO;

class SEOController extends Controller
{
    protected $seo;

    public function __construct(SEO $seo)
    {
        $this->middleware('auth:admin');
        $this->seo = $seo;
    }

    public function seo()
    {
        $seo = $this->seo->first();

        return view('admin.others.seo', compact('seo'));
    }

    public function updateSEO(Request $request)
    {
        $id = $request->id;
        $this->seo->find($id)->update($request->all());

        $notification = array(
            'message' => 'SEOが更新されました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
