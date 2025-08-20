<?php

namespace App\Http\Controllers\Payments\IyZico;

use Redirect;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\PaymentsController;

class IyZicoController extends Controller
{
    # init payment
    public function initPayment()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECRET_KEY'));

        if(paymentGateway('midtrans')?->sandbox == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {            
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        $iyzicoRequest = new \Iyzipay\Request\CreatePayWithIyzicoInitializeRequest();
        $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzicoRequest->setConversationId('123456789');

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId("BY789");
        $buyer->setName("John");
        $buyer->setSurname("Doe");
        $buyer->setEmail("email@email.com");
        $buyer->setIdentityNumber("74300864791");
        $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
        $buyer->setCity("Istanbul");
        $buyer->setCountry("Turkey");
        $iyzicoRequest->setBuyer($buyer);

        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName("Jane Doe");
        $shippingAddress->setCity("Istanbul");
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
        $iyzicoRequest->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName("Jane Doe");
        $billingAddress->setCity("Istanbul");
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
        $iyzicoRequest->setBillingAddress($billingAddress);

        $amount = session('amount');
        $supportedCurrency = [
            "TRY",
            "EUR",
            "GBP",
            "IRR",
            "NOK",
            "RUB",
            "CHF"
        ];

        if (Session::has('currency_code')) {
            if (in_array(Session::get('currency_code'), $supportedCurrency)) {
                $currencyCode = Session::get('currency_code');
            } else {
                $currencyCode = 'USD';
                $amount = priceToUsd($amount);
            }
        } else {
            $currencyCode = 'USD';
            $amount = priceToUsd($amount);
        }


        $iyzicoRequest->setPrice(round($amount));
        $iyzicoRequest->setPaidPrice(round($amount));
        $iyzicoRequest->setCurrency($currencyCode);
        $iyzicoRequest->setBasketId(rand(000000, 999999));
        $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);

        $iyzicoRequest->setCallbackUrl(route('iyzico.callback'));

        $basketItems = array();
        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        $firstBasketItem->setId(rand(1000, 9999));
        $firstBasketItem->setName("Order Payment");
        $firstBasketItem->setCategory1("Accessories");
        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
        $firstBasketItem->setPrice(round($amount));
        $basketItems[0] = $firstBasketItem;

        $iyzicoRequest->setBasketItems($basketItems);

        # make request
        $payWithIyzicoInitialize = \Iyzipay\Model\PayWithIyzicoInitialize::create($iyzicoRequest, $options);

        # print result
        if ($payWithIyzicoInitialize->getPayWithIyzicoPageUrl() != null) {
            return Redirect::to($payWithIyzicoInitialize->getPayWithIyzicoPageUrl());
        } else {
            return (new PaymentsController)->payment_failed();
        }
    }

    # callback  
    public function callback(Request $request)
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECRET_KEY'));

        if(paymentGateway('midtrans')?->sandbox == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        $iyzicoRequest = new \Iyzipay\Request\RetrievePayWithIyzicoRequest();
        $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzicoRequest->setConversationId('123456789');
        $iyzicoRequest->setToken($request->token);
        # make request
        $payWithIyzico = \Iyzipay\Model\PayWithIyzico::retrieve($iyzicoRequest, $options);

        if ($payWithIyzico->getStatus() == 'success') {
            $response = $payWithIyzico->getRawResult();
            return (new PaymentsController)->payment_success($response);
        } else {
            return (new PaymentsController)->payment_failed();
        }
    }
}
