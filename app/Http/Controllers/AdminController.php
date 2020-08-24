<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show admin home view
     *
     * @return void
     */
    public function index() {
        return view('admin.home');
    }

    /**
     * Show change pass form view
     *
     * @return void
     */
    public function showChangePasswordForm() {
        return view('admin.auth.password_change');
    }

    /**
     * Change admin user pass
     *
     * @param Request $request
     * @return void
     */
    public function changePassword(Request $request) {
        $password = Auth::user()->password;
        $oldpass = $request->oldpassword;
        $newpass = $request->password;
        $confirm = $request->password_confirmation;

        if (Hash::check($oldpass, $password)) {
            if ($newpass === $confirm) {
                $user = Admin::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();

                $notification = array(
                    'message' => 'パスワードは変更されました。',
                    'alert-type' => 'success'
                );

                return redirect()->route('admin.login')->with($notification);
            } else {
                $notification = array(
                    'message' => '新しいパスワードと確認用を合わせて下さい。',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'パスワードが違います。',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function logout() {
        Auth::Logout();
        $notification = array(
            'message' => 'ログアウトしました',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.login')->with($notification);
    }
}
