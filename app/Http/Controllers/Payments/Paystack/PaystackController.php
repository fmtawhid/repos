<?php

namespace App\Http\Controllers\Payments\Paystack;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\PaymentsController;
use App\Models\Currency;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Paystack;


class PaystackController extends Controller
{
    # init payment
    public function initPayment()
    {
        $user = auth()->user();
        $amount = session('amount');

        $request            = new Request;
        $request->email     = $user->email;
        $request->amount    = round($amount  * 100);

        $request->currency  = env('PAYSTACK_CURRENCY_CODE', 'USD');

        $currency = Currency::where('code', $request->currency)->first();
        if(!is_null($currency) && $request->currency != "USD" && strtolower(session('currency_code')) != strtolower(env('PAYSTACK_CURRENCY_CODE'))){
            $request->amount = round($request->amount * (double) $currency->rate);
        }

        $request->reference = Paystack::genTranxRef();
        return Paystack::getAuthorizationUrl($request)->redirectNow();
    }

    # callback  
    public function callback()
    {
        $payment = Paystack::getPaymentData();

        $payment_detalis = json_encode($payment);
        if (!empty($payment['data']) && $payment['data']['status'] == 'success') {
            return (new PaymentsController)->payment_success(json_encode($payment_detalis));
        } else {
            return (new PaymentsController)->payment_failed();
        }
    }
}
