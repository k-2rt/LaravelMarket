<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Auth;

class AddressController extends Controller
{
    protected $address;

    public function __construct(Address $address) {
        $this->address = $address;
    }

    /**
     * Update user info
     *
     * @param AddressRequest $request
     * @return void
     */
    public function updateUserInfo(AddressRequest $request) {
        $user = Auth::user();
        $user->fill($request->all())->save();

        $notification = array(
            'message' => 'ユーザー情報を更新しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show user page
     *
     * @return void
     */
    public function showUserPage() {
        $prefs = config('pref');
        $user = Auth::user();

        return view('main.address', compact('prefs', 'user'));
    }
}
