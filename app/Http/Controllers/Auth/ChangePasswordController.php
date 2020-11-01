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
            if ($new_pass === $confirm_pass && strlen($new_pass) >= 8) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                $notification = array(
                    'message' => 'パスワードを変更しました',
                    'alert-type' => 'success'
                );

                return redirect()->route('home')->with($notification);
            } else if (strlen($new_pass) < 8) {
                $notification = array(
                    'errMessage' => '新しいパスワードは８桁以上で入力してください',
                );
            } else {
                $notification = array(
                    'errMessage' => '新しいパスワードと確認用を一致させて下さい',
                );
            }
        } else {
            $notification = array(
                'errMessage' => '正しいパスワードを入力して下さい',
            );
        }

        return redirect()->back()->with($notification);
    }
}
