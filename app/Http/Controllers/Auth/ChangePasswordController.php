<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request) {
        $password = Auth::user()->password;
        $old_pass = $request->old_password;
        $new_pass = $request->password;
        $confirm_pass = $request->password_confirmation;

        if (Hash::check($old_pass, $password)) {
            if ($new_pass === $confirm_pass) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();

                $notification = array(
                    'message' => 'パスワードは変更されました',
                    'alert-type' => 'success'
                );

                return redirect()->route('login')->with($notification);
            }

            $notification = array(
                'errMessage' => '新しいパスワードと確認用を一致させて下さい',
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'errMessage' => '正しいパスワードを入力して下さい',
            );

            return redirect()->back()->with($notification);
        }
    }
}
