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

    public function updateShippingAddress(AddressRequest $request) {
        $data = $request->all();
        $user = Auth::user();
        $user->fill($data)->save();

        $notification = array(
            'message' => '住所を更新しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function showAddressPage() {
        $prefs = config('pref');
        $user = Auth::user();

        return view('main.address', compact('prefs', 'user'));
    }
}
