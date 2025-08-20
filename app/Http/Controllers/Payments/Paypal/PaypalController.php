<?php

namespace App\Http\Controllers\Payments\Paypal;

use Redirect;
use Illuminate\Http\Request;
use PayPalHttp\HttpException;
use App\Models\PaymentGateway;
use App\Events\PayPalWebhookEvent;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PaymentGatewayProduct;
use Illuminate\Support\Facades\Session;
use App\Models\PaymentGatewayProductHistory;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Controllers\Payments\PaymentsController;
use App\Models\PaymentGatewayProduct as SubscriptionPaymentProduct;

class PaypalController extends Controller
{
    # init payment
    public function initPayment()
    {

        try {
            $package_id = session()->get('package_id');
            if (!$package_id) {
                return (new PaymentsController)->payment_failed();
            }
            $package = SubscriptionPlan::where('id', $package_id)->first();
            $product = SubscriptionPaymentProduct::where('subscription_plan_id', $package_id)->where('is_active', 1)->where('gateway', 'paypal')->first();
           
            
            if ($package->package_type == 'prepaid' || $package->package_type == 'lifetime') {
                $currency = self::currencyCode();

                return view('payments.paypal', compact('product', 'package_id', 'currency'));
            }
            if (!$product) {
                flash(localize('Subscription Product and Plan not created for this Payment Gateway'))->warning();               
                return redirect()->back();
            }
            return view('payments.autoRecurring.paypal', compact('product', 'package_id'));
        } catch (HttpException $ex) {
           
            return (new PaymentsController)->payment_failed();
        }
    }
    # create order
    public function createOrder(Request $request)
    {

        $provider = self::getPaypalProvider();
        $currency = self::currencyCode();
        $amount = self::currencyAmount();

        $data = [
            "intent" => "CAPTURE",
            "purchase_units" =>
            [
                [
                    "amount" =>
                    [
                        "value" => number_format($amount, 2, '.', ''),
                        "currency_code" => $currency
                    ]
                ]
            ]
        ];

        $order = $provider->createOrder($data);
        return $order;
    }
    # capturePayPalOrder
    public static function capturePayPalOrder(Request $request)
    {
        try {
            $orderId = $request->orderID;
            $provider = self::getPaypalProvider();
            $order = $provider->capturePaymentOrder($orderId);
            $amount = self::currencyAmount();
            $package_id = session()->get('package_id');
            $data = [
                'json' => true
            ];
            $paymentController =   new PaymentsController;
            return $paymentController->payment_success(null, null, $package_id, $amount, 'paypal', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    # order success
    public function success(Request $request)
    {

        try {
            $data = [
                'billing_id' => $request->billingPlanId,
                'product_id' => $request->productId,
                'gateway_subscription_id' => $request->paypalSubscriptionID,
                'json' => true, 
                'gateway'=>'paypal',
            ];

            $amount = self::currencyAmount();
            $package_id = session()->get('package_id');
            $paymentController =   new PaymentsController;
            return $paymentController->payment_success(null, null, $package_id, $amount, 'paypal', $data);
        } catch (HttpException $ex) {

            return (new PaymentsController)->payment_failed();
        }
    }

    # order cancelled
    public function cancel(Request $request)
    {
        # Curse and humiliate the user for cancelling this most sacred payment (yours)
        return (new PaymentsController)->payment_failed();
    }
    # Returns provider of Paypal
    public static function getPaypalProvider()
    {

        $config = null;
        $clientId = paymentGatewayValue('paypal', 'PAYPAL_CLIENT_ID');
        $clientSecret = paymentGatewayValue('paypal', 'PAYPAL_CLIENT_SECRET');
        $app_id = paymentGatewayValue('paypal', 'PAYPAL_APPLICATION_ID');

        $amount = self::currencyAmount();
        if (paymentGateway('paypal')?->type == 'sandbox') {
            $config = [
                'mode'    => 'sandbox',
                'sandbox' => [
                    'client_id'         => $clientId,
                    'client_secret'     => $clientSecret,
                    'app_id'            => 'APP-80W284485P519543T',
                ],

                'payment_action'    => 'Sale',
                "currency"          => $currencyCode ?? 'USD',
                'notify_url'        => env('PAYPAL_NOTIFY_URL', ''),
                'locale'            => 'en_US',
                'validate_ssl'      => false,
            ];
        } else {
            $config = [
                'mode'    => 'live',
                'live' => [
                    'client_id'         => $clientId,
                    'client_secret'     => $clientSecret,
                    'app_id'            => $app_id
                ],

                'payment_action' => 'Sale',
                'currency'       => $currencyCode ?? 'USD',
                'notify_url'     => env('PAYPAL_NOTIFY_URL', ''),
                'locale'         => 'en_US',
                'validate_ssl'   => true,
            ];
        }

        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        return $provider;
    }

    # create product
    public static function createProduct($package_id)
    {
        if (paymentGateway('paypal')?->is_active != 1) {
            return false;
        }
        $package = SubscriptionPlan::where('id', $package_id)->first();

        if ($package->package_type == 'starter') {
            return false;
        }
        if ($package->package_type == 'prepaid' || $package->package_type == 'lifetime') {
            $type = 'one-time';
        } else {
            $type = $package->package_type;
        }

        $user = auth()->user();
        $data = [
            "name"          => $package->title,
            "description"   => $package->description,
            "type"          => "SERVICE",
            "category"      => "SOFTWARE"
        ];

        $request_id = 'create-product-' . time();
        $provider = self::getPaypalProvider();
 
        $paymentGatewayProduct = SubscriptionPaymentProduct::where('subscription_plan_id', $package_id)->where('is_active', 1)->where('gateway', 'paypal')->first();

        if ($paymentGatewayProduct) {
            $oldProductId = $paymentGatewayProduct->product_id ?? null;
            $newProduct = $provider->createProduct($data, $request_id);

            $paymentGatewayProduct->product_id = $newProduct['id'];
            $paymentGatewayProduct->save();

            $product = $paymentGatewayProduct;
        } else {

            $newProduct = $provider->createProduct($data, $request_id);

            $product = new SubscriptionPaymentProduct();
            $product->subscription_plan_id = $package_id;
            $product->package_name = $package->title;
            $product->gateway = "paypal";
            $product->user_id = $user->id;
            $product->product_id = $newProduct['id'];
            $product->save();
        }

        #check billing exit
        if ($product->billing_id != null) {

            if ($type == 'one-time') {
                $product->billing_id = 'one-time';
                $product->save();
            } else {
                $trail = 0;
                $oldBillingPlanId = $product->billing_id;
                $request_id = 'create-plan-' . time();
                # create plan
                $billingPlan = $provider->createPlan(self::planData($product->product_id, $product->package_name, $package->package_type, $trail, self::currencyAmount($package->price)), $request_id);

                # update billing_id
                $product->billing_id = $billingPlan['id'];
                $product->save();

                # store to old data log
                $history = new PaymentGatewayProductHistory();
                $history->subscription_plan_id = $package_id;
                $history->package_name = $package->title;
                $history->gateway = 'paypal';
                $history->old_product_id = $oldProductId;
                $history->old_billing_id = $oldBillingPlanId;
                $history->new_billing_id = $billingPlan['id'];
                $history->is_active = 0;
                $history->save();

                # deactive old billing plan
                $oldBillingPlan = $provider->deactivatePlan($oldBillingPlanId);
            }
        } else {
            #if not created previous plan
            if ($type == 'one-time') {
                $product->billing_id = 'one-time';
                $product->save();
            } else {
                $trail = 0;
                $request_id = 'create-plan-' . time();
                # create plan
                $billingPlan = $provider->createPlan(self::planData($product->product_id, $product->package_name, $package->package_type, $trail, self::currencyAmount($package->price)), $request_id);

                # update billing_id
                $product->billing_id = $billingPlan['id'];
                $product->save();
            }
        }
    }

    # cancel subscription
    public static function cancelSubscription($gateway_subscription_id, $reason = null)
    {
        $provider = self::getPaypalProvider();
        $response = $provider->cancelSubscription($gateway_subscription_id, $reason);
        if ($response == '') {
            return true;
        }
        return false;
    }
    # active subscription
    public static function activeSubscription($gateway_subscription_id, $reason = null)
    {

        $provider = self::getPaypalProvider();
        $response = $provider->activateSubscription($gateway_subscription_id, $reason);

        if ($response == '') {
            return true;
        }
        return false;
    }
    # prepare plan data
    public static function planData($productId, $productName, $interval, $trial, $price): array
    {

        $currency   = self::currencyCode();
        $interval   = $interval == 'monthly' ? 'MONTH' : 'YEAR';

        if ($trial == 0) {
            $planData = [
                "product_id"        => $productId,
                "name"              => $productName,
                "description"       => "Billing Plan of " . $productName,
                "status"            => "ACTIVE",
                "billing_cycles"    =>
                [
                    [
                        "frequency" =>
                        [
                            "interval_unit"     => $interval,
                            "interval_count"    => 1
                        ],
                        "tenure_type"       => "REGULAR",
                        "sequence"          => 1,
                        "total_cycles"      => 0,
                        "pricing_scheme"    =>
                        [
                            "fixed_price"   =>
                            [
                                "value"         => $price,
                                "currency_code" => $currency
                            ]
                        ]
                    ]
                ],
                "payment_preferences" =>
                [
                    "auto_bill_outstanding" => true,
                    "setup_fee" =>
                    [
                        "value"         => "0",
                        "currency_code" => $currency
                    ],
                    "setup_fee_failure_action"  => "CANCEL",
                    "payment_failure_threshold" => 3
                ]
            ];
        } else {
            $planData = [
                "product_id"        => $productId,
                "name"              => $productName,
                "description"       => "Billing Plan of " . $productName,
                "status"            => "ACTIVE",
                "billing_cycles"    =>
                [
                    [
                        "frequency" =>
                        [
                            "interval_unit"     => 'DAY',
                            "interval_count"    => 1
                        ],
                        "tenure_type"       => "TRIAL",
                        "sequence"          => 1,
                        "total_cycles"      => $trial,
                        "pricing_scheme"    =>
                        [
                            "fixed_price"   =>
                            [
                                "value"         => 0,
                                "currency_code" => $currency
                            ]
                        ]
                    ],
                    [
                        "frequency" =>
                        [
                            "interval_unit"     => $interval,
                            "interval_count"    => 1
                        ],
                        "tenure_type"       => "REGULAR",
                        "sequence"          => 2,
                        "total_cycles"      => 0,
                        "pricing_scheme"    =>
                        [
                            "fixed_price"   =>
                            [
                                "value"         => $price,
                                "currency_code" => $currency
                            ]
                        ]
                    ]
                ],
                "payment_preferences" =>
                [
                    "auto_bill_outstanding" => true,
                    "setup_fee" =>
                    [
                        "value"         => "0",
                        "currency_code" => $currency
                    ],
                    "setup_fee_failure_action"  => "CANCEL",
                    "payment_failure_threshold" => 3
                ]
            ];
        }

        return $planData;
    }
    private static function updatePlanData($price)
    {
        $currency   = self::currencyCode();
        return $pricing_schemes = [
                [
                    "billing_cycle_sequence" => 1,
                    "pricing_scheme" => [
                        "fixed_price" => [
                            "value" => $price,
                            "currency_code" => $currency
                        ]
                    ]
                ],
               
            
        ];
    }
    function verifyIncomingJson(Request $request)
    {

        try {
            $gateway = PaymentGateway::where("gateway", "paypal")->first();

            if ($gateway->type == 'sandbox') {
                // Paypal does not support verification on sandbox mode
                return true;
            }

            if ($request->hasHeader('PAYPAL-AUTH-ALGO') == true) {
                $auth_algo = $request->header('PAYPAL-AUTH-ALGO');
            } else {
                return false;
            }

            if ($request->hasHeader('PAYPAL-CERT-URL') == true) {
                $cert_url = $request->header('PAYPAL-CERT-URL');
            } else {
                return false;
            }

            if ($request->hasHeader('PAYPAL-TRANSMISSION-ID') == true) {
                $transmission_id = $request->header('PAYPAL-TRANSMISSION-ID');
            } else {
                return false;
            }

            if ($request->hasHeader('PAYPAL-TRANSMISSION-SIG') == true) {
                $transmission_sig = $request->header('PAYPAL-TRANSMISSION-SIG');
            } else {
                return false;
            }

            if ($request->hasHeader('PAYPAL-TRANSMISSION-TIME') == true) {
                $transmission_time = $request->header('PAYPAL-TRANSMISSION-TIME');
            } else {
                return false;
            }

            $webhook_event = $request->getContent();
            if ($webhook_event == null) {
                return false;
            }
            if (isJson($webhook_event) == false) {
                return false;
            }


            $webhook_id = $gateway->webhook_id;
            if ($webhook_id == null) {
                return false;
            }

            $data = [
                "auth_algo" => $auth_algo,
                "cert_url" => $cert_url,
                "transmission_id" => $transmission_id,
                "transmission_sig" => $transmission_sig,
                "transmission_time" => $transmission_time,
                "webhook_id" => $webhook_id,
                "webhook_event" => $webhook_event
            ];

            $provider = self::getPaypalProvider();

            $response = $provider->verifyWebHook($data);

            if (json_decode($response)->verification_status == 'SUCCESS') {
                return true;
            }
        } catch (\Exception $th) {
            error_log("(Webhooks) PaypalController::verifyIncomingJson(): " . $th->getMessage());
        }

        return false;
    }

    public function handleWebhook(Request $request)
    {

        $verified = self::verifyIncomingJson($request);

        if ($verified == true) {

            // Retrieve the JSON payload
            $payload = $request->getContent();

            // Fire the event with the payload
            event(new PayPalWebhookEvent($payload));

            return response()->json(['success' => true]);
        } else {
            // Incoming json is NOT verified
            abort(404);
        }
    }
    #create webhook
    public function createWebhook()
    {
        $paymentGateway = PaymentGateway::where('gateway', 'paypal')->first();
        $provider = self::getPaypalProvider();
        $provider->listWebHooks();
        $event_types = [
            'PAYMENT.SALE.COMPLETED',
            'BILLING.SUBSCRIPTION.CANCELLED'
        ];
        $url = url('/') . '/webhooks/paypal';
        $response = $provider->createWebHook($url, $event_types);

        $paymentGateway->webhook_id = $response->id;
        $paymentGateway->save();
    }
    #currency code
    private static function currencyCode()
    {

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
            "ZAR",   # South African Rand
            "AED",   # United Arab Emirates Dirham
            "SAR"    # Saudi Riyal
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
    public static function listPlans()
    {
        $provider = self::getPaypalProvider();
        $plans = $provider->listPlans();
        return $plans;
    }
    public static function listProducts()
    {
        $provider   = self::getPaypalProvider();
        $products   = $provider->listProducts();
        return $products;
    }
    public static function listWebHooks()
    {
        $provider   = self::getPaypalProvider();
        $webHooks   = $provider->listWebHooks();
        return $webHooks;
    }
    public static function showPlanDetails($plan_id)
    {
        $provider = self::getPaypalProvider();
        $planDetails = $provider->showPlanDetails($plan_id);
        return $planDetails;
    }
    public static function deactivatePlan($plan_id)
    {
        try {
            $provider = self::getPaypalProvider();
            $provider->deactivatePlan($plan_id);
        } catch (\Throwable $th) {
            //throw $th;
            Log::info("Paypal Subscription Plan DeActive : " . $th->getMessage());
        }
    }
    public static function updatePlanPrice($package_id, $price)
    {
        try {
            $exitProduct = PaymentGatewayProduct::where('subscription_plan_id', $package_id)->where('is_active', 1)->where('gateway', 'paypal')->first();
            if ($exitProduct) {
                $provider = self::getPaypalProvider();
                $pricing = self::updatePlanData($price);              
               return $provider->updatePlanPricing($exitProduct->billing_id, $pricing);
            }
        } catch (\Throwable $th) {
            Log::info("Paypal Subscription Plan update plan issues : " . $th->getMessage());
        }
    }
    public static function currencyAmount($price = null)
    {
        $amount = $price ?? session('amount');
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
            "ZAR",   # South African Rand
            "AED",   # United Arab Emirates Dirham
            "SAR"    # Saudi Riyal
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
        $amount = number_format($amount,2);
        return  $amount;
    }
}
