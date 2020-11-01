<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Coupon;
use Cart;
use Auth;
use Session;
use App\Models\OrderSetting;

class CartController extends Controller
{
    protected $product;
    protected $coupon;
    protected $order_setting;

    public function __construct(Product $product, Coupon $coupon, OrderSetting $order_setting) {
        $this->product = $product;
        $this->coupon = $coupon;
        $this->order_setting = $order_setting;
    }

    /**
     * Add product to cart
     *
     * @param String $id
     * @return JSON
     */
    public function addProductToCart($id) {
        if (Auth::check()) {
            $data = $this->product->configureProductInfo($id);

            Cart::add($data);

            $notification = array(
                'type' => 'success',
                'message' => '商品をカートに追加しました',
            );
        } else {
            $notification = array(
                'type' => 'warning',
                'message' => 'ログインをして下さい',
            );
        }

        return response()->json($notification);
    }

    public function checkCart() {
        $content = Cart::content();

        return response()->json($content);
    }

    /**
     * Show cart view
     *
     * @return void
     */
    public function showCart() {
        $cart = Cart::content();
        $shipping_fee = $this->order_setting->first()->shipping_fee;

        return view('main.cart', compact('cart', 'shipping_fee'));
    }

    /**
     * Remove item from cart
     *
     * @param String $rowId
     * @return void
     */
    public function removeCartItem($rowId) {
        Cart::remove($rowId);

        $notification = array(
            'message' => '商品をカートから削除しました',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Update quantity of a item in cart
     *
     * @param Request $request
     * @return void
     */
    public function updateCartItem(Request $request) {
        $rowId = $request->product_id;
        $qty = $request->qty;

        Cart::update($rowId, $qty);

        $notification = array(
            'message' => '数量を変更しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Add item to cart from modal view
     *
     * @param Request $request
     * @return void
     */
    public function addCartFromModal(Request $request) {
        if (Auth::check()) {
            $data = $this->product->configureProductInfo($request->product_id);
            $data['qty'] = $request->qty;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;

            Cart::add($data);

            $notification = array(
                'message' => '商品をカートに追加しました',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'ログインをして下さい',
                'alert-type' => 'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    /**
     * Check out product
     *
     * @return void
     */
    public function checkoutProduct() {
        if (Auth::check()) {
            $cart = Cart::content();
            $user = Auth::user();
            $prefs = config('pref');
            $date = config('delivery');
            $stripe = config('app.stripe_api');
            $shipping_fee = $this->order_setting->first()->shipping_fee;

            return view('main.checkout', compact('cart', 'user', 'prefs', 'stripe', 'date', 'shipping_fee'));
        } else {
            $notification = array(
                'message' => 'ログインをして下さい',
                'alert-type' => 'warning'
            );

            return redirect()->route('login')->with($notification);
        }
    }

    /**
     * Apply coupon
     *
     * @param Request $request
     * @return void
     */
    public function applyCoupon(Request $request) {
        $coupon = $this->coupon->where('coupon', $request->coupon)->first();

        if ($coupon) {
            Session::put('coupon', [
                'id' => $coupon->id,
                'name' => $coupon->coupon,
                'discount' => $coupon->discount,
            ]);

            $notification = array(
                'message' => 'クーポンを適用しました',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'クーポンは見つかりません',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }

    /**
     * Remove coupon
     *
     * @return void
     */
    public function removeCoupon() {
        Session::forget('coupon');
        $notification = array(
            'message' => 'クーポンを削除しました',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
