<?php

namespace App\Http\Controllers\Payments\Stripe;

use Session;
use Stripe\Stripe;
use App\Models\SubscriptionPlan;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\PaymentsController;

class StripePaymentController extends Controller
{
    # stripe payment view
    public function initPayment()
    {
        $user       = user();
        $package_id = session('package_id');
       
        $amount     = session('amount');
        if($package_id && getSetting('enable_stripe_autoPayment') == 1){

            $package = SubscriptionPlan::query()->findOrFail($package_id);

            return  StripeWithAutoRecurringPaymentController::subscribe($package_id, $package);
        }

        return view('payments.stripe');
    }

    # init payment
    public function checkoutSession()
    {
        $amount = session('amount');
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $supportedCurrency = [
            "EUR",   # Euro
            "GBP",   # British Pound Sterling
            "CAD",   # Canadian Dollar
            "AUD",   # Australian Dollar
            "JPY",   # Japanese Yen
            "CHF",   # Swiss Franc
            "NZD",   # New Zealand Dollar
            "HKD",   # Hong Kong Dollar
            "SGD",   # Singapore Dollar
            "SEK",   # Swedish Krona
            "DKK",   # Danish Krone
            "PLN",   # Polish Złoty
            "NOK",   # Norwegian Krone
            "CZK",   # Czech Koruna
            "HUF",   # Hungarian Forint
            "ILS",   # Israeli New Shekel
            "MXN",   # Mexican Peso
            "BRL",   # Brazilian Real
            "MYR",   # Malaysian Ringgit
            "PHP",   # Philippine Peso
            "TWD",   # New Taiwan Dollar
            "THB",   # Thai Baht
            "TRY",   # Turkish Lira
            "RUB",   # Russian Ruble
            "INR",   # Indian Rupee
            "ZAR",   # South African Rand
            "AED",   # United Arab Emirates Dirham
            "SAR",   # Saudi Riyal
            "KRW",   # South Korean Won
            "CNY"    # Chinese Yuan
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

        $amount = number_format((float)$amount, 2, '.', '')  * 100;
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currencyCode,
                        'product_data' => [
                            'name' => "Payment"
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);
        return response()->json(['id' => $session->id, 'status' => 200]);
    }

    # successful payment
    public function success()
    {
        try {
            $payment = ["status" => "Success"];
            return (new PaymentsController)->payment_success(json_encode($payment));
        } catch (\Exception $e) {
            return (new PaymentsController)->payment_failed();
        }
    }

    # cancelled
    public function cancel()
    {
        return (new PaymentsController)->payment_failed();
    }
}
