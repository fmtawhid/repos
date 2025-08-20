<?php

namespace App\Http\Controllers\Payments\Paytm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\PaymentsController;
use App\Models\User;
use PaytmWallet;
use Str;

class PaytmPaymentController extends Controller
{
    # paytm init payment
    public function initPayment()
    {
        $user = User::find(auth()->user()->id);
        $amount = session('amount');
        $payment = PaytmWallet::with('receive');
        $payment->prepare([
            'order' => Str::random(6),
            'user' => $user->id,
            'mobile_number' => $user->phone != null ? $user->phone : "+912354123123",
            'email' => $user->email != null ? $user->email : "customer@example.com",
            'amount' => $amount,
            'callback_url' => route('paytm.callback')
        ]);
        return $payment->receive();
    }

    # paytm callback
    public function callback()
    {
        $transaction = PaytmWallet::with('receive');
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm

        if ($transaction->isSuccessful()) {
            return (new PaymentsController)->payment_success(json_encode($response));
        } elseif ($transaction->isFailed()) {
            return (new PaymentsController)->payment_failed();
        }
    }
}
