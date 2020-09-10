<?php

namespace App\Http\Controllers\Admin\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newsletter;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show newsletter view
     *
     * @return void
     */
    public function newsletter() {
        $newsletters = Newsletter::all();

        return view('admin.others.newsletter', compact('newsletters'));
    }

    /**
     * Store newsletter
     *
     * @return void
     */
    public function storeNewsletter(Request $request) {
        $request->validate([
            'email' => 'required|unique:newsletters|max:55',
        ]);

        Newsletter::create($request->all());

        $notification = array(
            'message' => '申し込みありがとうございます。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

     /**
     * Delete newsletter
     *
     * @param String $id
     * @return void
     */
    public function deleteNewsletter($id) {
        Newsletter::find($id)->delete();

        $notification = array(
            'message' => '申し込みを削除しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
