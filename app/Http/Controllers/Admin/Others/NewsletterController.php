<?php

namespace App\Http\Controllers\Admin\Others;

use App\Http\Controllers\Controller;
use App\Models\Admin\Newsletter;
use Auth;
use Mail;
use App\Mail\SubscribeMail;
use App\Mail\UnSubscribeMail;

class NewsletterController extends Controller
{
    protected $news_letter;

    public function __construct(Newsletter $news_letter)
    {
        $this->middleware('auth:admin')->except('storeNewsletter');
        $this->news_letter = $news_letter;
    }

    /**
     * Show newsletter view
     *
     * @return void
     */
    public function newsletter()
    {
        $newsletters = Newsletter::all();

        return view('admin.others.newsletter', compact('newsletters'));
    }

    /**
     * Store or soft delete newsletter & send email
     *
     * @return void
     */
    public function storeNewsletter()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $check = $this->news_letter->checkUserNewsInfo();

            if ($check === false) {
                $this->news_letter->create([
                    'user_id' => $user->id,
                    'email' => $user->email,
                ]);

                $notification = array(
                    'message' => 'お申し込みありがとうございます。',
                    'alert-type' => 'success'
                );

                $check_news = $this->news_letter->getUserNewsInfoAtTrashed();

                // Mail send to user for subscribe mail
                Mail::to($user->email)->send(new SubscribeMail([
                    'user_name' => $user->name,
                    'check_news' => $check_news->isEmpty(),
                ]));
            } else {
                $notification = array(
                    'message' => '定期購読を停止しました。',
                    'alert-type' => 'warning'
                );

                $this->news_letter->where('user_id', $user->id)->delete();

                // Mail send to user for unsubscribe mail
                Mail::to($user->email)->send(new UnSubscribeMail([
                    'user_name' => $user->name,
                ]));
            }
        } else {
            $notification = array(
                'message' => 'ログインをしてください。',
                'alert-type' => 'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

     /**
     * Delete newsletter
     *
     * @param String $id
     * @return void
     */
    public function deleteNewsletter($id)
    {
        Newsletter::find($id)->delete();

        $notification = array(
            'message' => '申し込みを削除しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
