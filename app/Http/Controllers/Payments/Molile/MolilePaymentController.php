<?php

namespace App\Http\Controllers\Payments\Molile;

use App\Http\Controllers\Payments\PaymentsController;
use App\Http\Controllers\Controller;
use Session;

class MolilePaymentController extends Controller
{
    public function initPayment()
    {
        $amount = session('amount');
        $currencyCode = 'USD';
        $amount = priceToUsd($amount);
        $amount = str_replace(',', '', number_format($amount, 2));

        try {
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey(env('MOLILE_API_KEY'));
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => strtoupper($currencyCode),
                    "value" => $amount
                ],
                "description" => 'Package Subscription Payment',
                "redirectUrl" => route('molile.redirect'),
            ]);

            Session::put('pay_id', $payment->id);
            return redirect($payment->getCheckoutUrl());
        } catch (\Exception $e) {
            return (new PaymentsController)->payment_failed();
        }
    }

    public function redirect()
    {
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey(env('MOLILE_API_KEY'));
        $pay_id = Session::get('pay_id');
        $payment = $mollie->payments->get($pay_id);

        if ($payment->isPaid()) {
            $payment = ["status" => "Success"];
            return (new PaymentsController)->payment_success(json_encode($payment));
        } else {
            return (new PaymentsController)->payment_failed();
        }
    }
}
