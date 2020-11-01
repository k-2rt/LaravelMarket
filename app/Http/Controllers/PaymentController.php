<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use Auth;
use Cart;
use Session;
use Mail;
use App\Mail\InvoiceMail;
use App\Models\OrderSetting;

class PaymentController extends Controller
{
    protected $order;
    protected $address;
    protected $order_setting;

    public function __construct(Order $order, Address $address, OrderSetting $order_setting)
    {
        $this->order = $order;
        $this->address = $address;
        $this->order_setting = $order_setting;
    }

    /**
     * Show a confirm page
     *
     * @return void
     */
    public function showConfirmPage(Request $request)
    {
        $user = Auth::user();

        if ($request->action === 'back') {
            return redirect()->route('show.cart');
        } else if ($user->checkAddress === false) {
            $notification = array(
                'message' => '送付先住所を入力してください',
                'alert-type' => 'danger'
            );

            return redirect()->back()->with($notification);
        }

        $cart = Cart::content();
        $date = config('delivery');
        $stripe = config('app.stripe_api');
        $delivery_date = $date['delivery_date'][$request->delivery_date];
        $delivery_date_val = $request->delivery_date;

        $delivery_time = $request->delivery_time;
        $shipping_fee = $this->order_setting->first()->shipping_fee;

        return view('main.confirm', compact('user', 'delivery_date', 'delivery_date_val', 'delivery_time', 'stripe', 'cart', 'shipping_fee'));
    }

    /**
     * Pay by stripe & send a mail
     *
     * @param Request $request
     * @return void
     */
    public function payByStripe(Request $request)
    {
        $discount = "";
        $coupon_id = NULL;
        $user = Auth::user();
        $date = config('delivery');
        $delivery_date = $request->delivery_date;
        $delivery_time = $request->delivery_time;
        $status_code = mt_rand(100000, 999999);


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
            'status_code' => $status_code,
            'order_date' => date('Y/m/d'),
            'subtotal' => Cart::subtotal(),
            'delivery_date' => $delivery_date,
            'delivery_time' => $delivery_time,
        ]);

        $order->shipping()->create([
            'ship_name' => $user->name,
            'ship_phone' => $user->phone,
            'ship_email' => $user->email,
            'ship_zip_code' => $user->zip_code,
            'ship_prefectures' => $user->prefectures,
            'ship_address1' => $user->address1,
            'ship_address2' => $user->address2,
            'delivery_date' => $delivery_date,
            'delivery_time' => $delivery_time,
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
            'ship_zip_code' => $user->hyphen_zip,
            'ship_address' => config('pref.' . $user->prefectures) . ' ' . $user->address1 . ' ' . $user->address2,
            'total' => $charge->amount,
            'discount' => $discount ? number_format($discount) : 0,
            'shipping_fee' => $request->shipping_fee,
            'order_date' => date('Y/m/d'),
            'subtotal' => Cart::subtotal(),
            'delivery_date' => $date['delivery_date'][$delivery_date],
            'delivery_time' => $delivery_time,
            'status_code' => $status_code,
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
