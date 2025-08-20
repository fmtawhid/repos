<?php

namespace App\Http\Controllers\Payments\Flutterwave;

use App\Http\Controllers\Payments\PaymentsController;
use App\Http\Controllers\Controller;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    # init payment
    public function initPayment()
    {
        $user = auth()->user();
        $amount = session('amount');
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $amount,
            'email' => $user->email,
            'tx_ref' => $reference,
            'currency' => "NGN",
            'redirect_url' => route('flutterwave.callback'),
            'customer' => [
                'email' => $user->email,
                "phone_number" => $user->phone ?? '123456789',
                "name" => $user->name
            ],

            "customizations" => [
                "title" => 'Subscription',
                "description" => "-"
            ]
        ];

        $payment = Flutterwave::initializePayment($data);

        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    # callback
    public function callback()
    {
        $status = request()->status;
        //if payment is successful
        if ($status ==  'successful') {
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            return (new PaymentsController)->payment_success(json_encode($data));
        } else {
            //Put desired action/code after transaction has failed here 
            return (new PaymentsController)->payment_failed();
        }
    }
}
