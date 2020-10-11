<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use Cart;
use Session;
use Mail;
use App\Mail\InvoiceMail;

class PaymentController extends Controller
{
    protected $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    /**
     * Show payment page
     *
     * @return void
     */
    public function showPaymentPage() {
        $prefs = config('pref');
        $user = Auth::user();

        return view('main.payment', compact('prefs', 'user'));
    }

    public function payByStripe(Request $request) {
        $discount = "";
        $coupon_id = NULL;
        $user = Auth::user();

        if (Session::has('coupon')) {
            $discount = Session::get('coupon')['discount'];
            $coupon_id = Session::get('coupon')['id'];
            $total = Cart::Subtotal() - $discount + $request->shipping_fee;
        } else {
            $total = Cart::subtotal() + $request->shipping_fee;
        }

        $stripe_secret = config('app.stripe_secret');
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey($stripe_secret);

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total,
            'currency' => 'jpy',
            'description' => 'Laravel Market Details',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        $order = $this->order->create([
            'user_id' => $user->id,
            'payment_id' => $charge->payment_method,
            'balance_transaction' => $charge->balance_transaction,
            'stripe_order_id' => $charge->metadata->order_id,
            'total' => $charge->amount,
            'coupon_id' => $coupon_id,
            'discount' => $discount,
            'shipping_fee' => $request->shipping_fee,
            'status_code' => mt_rand(100000, 999999),
            'order_date' => date('Y/m/d'),
            'subtotal' => Cart::subtotal(),
        ]);

        $order->shipping()->create([
            'ship_name' => $user->name,
            'ship_phone' => $user->phone,
            'ship_email' => $user->email,
            'ship_zip_code' => $user->zip_code,
            'ship_prefectures' => $user->prefectures,
            'ship_address1' => $user->address1,
            'ship_address2' => $user->address2,
        ]);

        $content = Cart::content();

        $data = [];
        foreach ($content as $item) {
            $data = $order->order_details()->create([
                'product_id' => $item->id,
                'product_name' => $item->name,
                'color' => $item->options->color,
                'size' => $item->options->size,
                'quantity' => $item->qty,
                'unit_price' => $item->price,
                'total_price' => $item->qty * $item->price,
            ]);
        }

        // Mail send to user for Invoice
        Mail::to($user->email)->send(new InvoiceMail([
            'user_name' => $user->name,
            'ship_zip_code' => $user->zip_code,
            'ship_address' => config('pref.' . $user->prefectures) . ' ' . $user->address1 . ' ' . $user->address2,
            'payment_id' => $charge->payment_method,
            'total' => $charge->amount,
            'discount' => $discount ? number_format($discount) : 0,
            'shipping_fee' => $request->shipping_fee,
            'order_date' => date('Y/m/d'),
            'subtotal' => Cart::subtotal(),
        ]));

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification = array(
            'message' => 'お支払いが完了しました',
            'alert-type' => 'success'
        );

        return redirect()->to('/')->with($notification);
    }
}
