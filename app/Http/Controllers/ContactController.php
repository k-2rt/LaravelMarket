<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SiteSetting;
use App\Models\Contact;

class ContactController extends Controller
{
    protected $site_set;
    protected $contact;

    public function __construct(SiteSetting $site_set, Contact $contact)
    {
        $this->middleware('auth:admin');
        $this->site_set = $site_set;
        $this->contact = $contact;
    }

    public function showContactPage()
    {
        $site = $this->site_set->first();

        return view('main.contact', compact('site'));
    }

    public function showMessageLists()
    {
        $messages = $this->contact->get();

        return view('admin.contact.message', compact('messages'));
    }

    public function sendContactMessage(Request $request)
    {
        $this->contact->create($request->all());

        $notification = array(
            'message' => 'メッセージを送信しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
