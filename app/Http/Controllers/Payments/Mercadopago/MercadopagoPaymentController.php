<?php

namespace App\Http\Controllers\Payments\Mercadopago;

use MercadoPago;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Payments\PaymentsController;

class MercadopagoPaymentController extends Controller
{
    public function initPayment()
    {
        $amount = session('amount');
        // $amount = priceToUsd($amount);
        $supportedCurrency = [
            "ARS",   # Euro
            "BOB",   # British Pound Sterling
            "BRL",   # Canadian Dollar
            "CLF",   # Australian Dollar
            "CLP",   # Japanese Yen
            "COP",   # Swiss Franc
            "CRC",   # New Zealand Dollar
            "CUC",   # Hong Kong Dollar
            "CUP",   # Singapore Dollar
            "DOP",   # Swedish Krona
            "EUR",   # Danish Krone
            "GTQ",   # Polish Złoty
            "HNL",   # Norwegian Krone
            "MXN",   # Czech Koruna
            "NIO",   # Hungarian Forint
            "PAB",   # Israeli New Shekel
            "PEN",   # Mexican Peso
            "PYG",   # Brazilian Real
            "USD",   # Malaysian Ringgit
            "UYU",   # Philippine Peso
            "VEF",   # New Taiwan Dollar
            "VES",   # Thai Baht
           
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
        try {
            //Payment
            MercadoPago\SDK::setAccessToken(env('MERCADOPAGO_SECRET_KEY'));
            $preference = new MercadoPago\Preference();
            $payer = new MercadoPago\Payer();
            $payer->name = auth()->user()->name;
            $payer->email = auth()->user()->email ? auth()->user()->email : "email@email.com";
            $payer->date_created = Carbon::now();

            $url = route('mercadopago.redirect');

            $preference->back_urls = array(
                "success" => $url,
                "failure" => route('mercadopago.failed'),
                "pending" => $url,
            );

            $preference->auto_return = "approved";

            // Create a preference item
            $item = new MercadoPago\Item();
            $item->title = 'Package Subscription Payment';
            $item->quantity = 1;
            $item->currency_id = $currencyCode;
            $item->unit_price = $amount;

            $preference->items = array($item);
            $preference->payer = $payer;
            $preference->save();

            $redirectUrl = paymentGateway('mercadopago')?->type == 'sandbox' ? $preference->sandbox_init_point : $preference->init_point;

            return redirect($redirectUrl);
        } catch (\Throwable $th) {
            return (new PaymentsController)->payment_failed();
        }
    }
    private static function currencyCode()
    {
        $supportedCurrency = [
            "ARS",   # Euro
            "BOB",   # British Pound Sterling
            "BRL",   # Canadian Dollar
            "CLF",   # Australian Dollar
            "CLP",   # Japanese Yen
            "COP",   # Swiss Franc
            "CRC",   # New Zealand Dollar
            "CUC",   # Hong Kong Dollar
            "CUP",   # Singapore Dollar
            "DOP",   # Swedish Krona
            "EUR",   # Danish Krone
            "GTQ",   # Polish Złoty
            "HNL",   # Norwegian Krone
            "MXN",   # Czech Koruna
            "NIO",   # Hungarian Forint
            "PAB",   # Israeli New Shekel
            "PEN",   # Mexican Peso
            "PYG",   # Brazilian Real
            "USD",   # Malaysian Ringgit
            "UYU",   # Philippine Peso
            "VEF",   # New Taiwan Dollar
            "VES",   # Thai Baht
           
        ];
        if (Session::has('currency_code')) {
            if (in_array(strtoupper(Session::get('currency_code')), $supportedCurrency)) {
                $currencyCodeCode = strtoupper(Session::get('currency_code'));
            } else {
                $currencyCodeCode = 'USD';
              
            }
        } else {
            $currencyCodeCode = 'USD';
          
        }
        $currencyCodeCode = $currencyCodeCode;
        return $currencyCodeCode;
    }
    public function redirect()
    {
        $response = Request()->all();
        if ($response['status'] == 'approved') {

            $payment = ["status" => "Success"];
            return (new PaymentsController)->payment_success(json_encode($payment));
        } else {

            return (new PaymentsController)->payment_failed();
        }
    }

    public function failed()
    {
        return (new PaymentsController)->payment_failed();
    }
}
