<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show payment page
     *
     * @return void
     */
    public function showPaymentPage() {
        return view('main.payment');
    }

    public function processPayment(Request $request) {
        $payment = $request->payment;

        dd($payment);
    }
}
