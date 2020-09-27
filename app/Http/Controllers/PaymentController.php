<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use Cart;
use Session;

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

        return view('main.payment.stripe', compact('prefs', 'user'));
    }

    public function processPayment(Request $request) {

        if ($request->payment === 'stripe') {
            return view('main.payment.stripe');
        } else if ($request->payment === 'paypal') {
            return view('main.payment.stripe');
        } else if ($request->payment === 'ideal') {
            return view('main.payment.stripe');
        } else {

        }
    }

    public function payByStripe(Request $request) {

        if (Session::has('coupon')) {
            $discount = Session::get('coupon')['discount'];
            $total = Cart::Subtotal() - $discount + $request->shipping_fee;
        } else {
            $total = Cart::subtotal() + $request->shipping_fee;
            $discount = "";
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
            'user_id' => Auth::id(),
            'payment_id' => $charge->payment_method,
            'balance_transaction' => $charge->balance_transaction,
            'stripe_order_id' => $charge->metadata->order_id,
            'total' => $charge->amount,
            'discount' => $discount,
            'shipping_fee' => $request->shipping_fee,
            'payment_type' => $request->payment_type,
            'order_date' => date('Y/m/d H:i:s'),
            'subtotal' => Cart::subtotal(),
        ]);

        $user = Auth::user();

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

        foreach ($content as $item) {
            $order->order_details()->create([
                'product_id' => $item->id,
                'product_name' => $item->name,
                'color' => $item->options->color,
                'size' => $item->options->size,
                'quantity' => $item->qty,
                'unit_price' => $item->price,
                'total_price' => $item->qty * $item->price,
            ]);
        }

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
