<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Coupon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show coupon view
     *
     * @return void
     */
    public function coupon() {
        $coupons = Coupon::all();
        $discount_percent = config('coupon');

        return view('admin.coupon.coupon', compact('coupons', 'discount_percent'));
    }

    /**
     * Store coupon
     *
     * @param Request $request
     * @return void
     */
    public function storeCoupon(Request $request) {
        $request->validate([
            'coupon' => 'required',
            'discount'  => 'required',
        ]);

        Coupon::create($request->all());

        $notification = array(
            'message' => 'クーポンを追加しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Delete coupon
     *
     * @param String $id
     * @return void
     */
    public function deleteCoupon($id) {
        Coupon::find($id)->delete();

        $notification = array(
            'message' => 'クーポンを削除しました。',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show edit coupon view
     *
     * @param String $id
     * @return void
     */
    public function editCoupon($id) {
        $coupon = Coupon::find($id);
        $discount_percent = config('coupon');

        return view('admin.coupon.edit_coupon', compact('coupon', 'discount_percent'));
    }

    /**
     * Update coupon
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateCoupon(Request $request, $id) {
        $request->validate([
            'coupon' => 'required',
            'discount'  => 'required',
        ]);

        Coupon::find($id)->update($request->all());

        $notification = array(
            'message' => 'クーポンを更新しました。',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.coupon')->with($notification);
    }
}
