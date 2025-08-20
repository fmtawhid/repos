<?php

namespace App\Http\Controllers\Payments\Razorpay;

use Razorpay\Api\Api;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Payments\PaymentsController;

class RazorpayController extends Controller
{

    # init payment
    public function initPayment()
    {
        $user = auth()->user();

        $title = '';
        $amount = session('amount');
        $supportedCurrency = [
            "INR",   # Indian Rupee
            "USD",   # United States Dollar $
            "EUR",   # European Euro €
            "GBP",   # Pound Sterling  £          
            "SGD",   # Singapore Dollar S$
            "AED",   # United Arab Emirates Dirham د.إ
            "AUD",   # Australian Dollar AU$
            "CAD",   # Canadian Dollar CA$
            "CNY"    # Chinese Yuan Renminbi ¥
        ];
        if (Session::has('currency_code')) {
            if (in_array(strtoupper(Session::get('currency_code')), $supportedCurrency)) {
                $currencyCode = strtoupper(Session::get('currency_code'));
            } else {
                $currencyCode = 'USD';
                $amount = priceToUsd($amount);
            }
        } else {
            $currencyCode = 'USD';
            $amount = priceToUsd($amount);
        }
        $data = [
            'amount' => $amount * 100,
            'currency' => $currencyCode,
            'name' => $user->name,
            'email' => $user->email,
            'app_name' => env('APP_NAME'),
            'app_logo' => urlVersion(getSetting('navbar_logo')),
            'payment_title' => $title
        ];
        return view('payments.razorpay', compact('data'));
    }


    # make payment
    public function payment(Request $request)
    {
        //Input items of form
        $input = $request->all();
        //get API Configuration
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            $payment_details = null;
            try {

                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment_details = json_encode(array(
                    'id' => $response['id'],
                    'method' => $response['method'],
                    'amount' => $response['amount'],
                    'currency' => $response['currency']
                ));
            } catch (\Exception $e) {
                return (new PaymentsController)->payment_failed();
            }
            return (new PaymentsController)->payment_success(json_encode($payment_details));
        } else {
            return (new PaymentsController)->payment_failed();
        }
    }
}
