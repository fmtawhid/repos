<?php

namespace App\Http\Controllers\Payments\Stripe;

use Stripe\Exception\ApiErrorException;
use Throwable;
use Stripe\Stripe;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionItems;
use App\Events\StripeWebhookEvent;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentGatewayProduct;
use Illuminate\Support\Facades\Session;
use App\Models\PaymentgatewayProductHistory;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\InvalidArgumentException;
use App\Models\Subscriptions as SubscriptionsModel;
use App\Http\Controllers\Payments\PaymentsController;
use App\Models\PaymentGatewayProduct as SubscriptionPaymentProduct;
use App\Models\OldPaymentGatewayProduct as OldSubscriptionPaymentProduct;

class StripeWithAutoRecurringPaymentController extends Controller
{

    public static function initStripeClient()
    {
        return $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public static function cashierConfig()
    {
        config(['cashier.key' => paymentGatewayValue('stripe', 'STRIPE_SECRET')]);
        config(['cashier.secret' => paymentGatewayValue('stripe', 'STRIPE_SECRET')]);
        config(['cashier.currency' => self::currency()]);
    }

    /**
     * Displays Payment Page of Stripe gateway.
     * @throws ApiErrorException
     */
    public static function subscribe($package_id, $package, $incomingException = null)
    {
        // SubscriptionPaymentProduct is a alias of PaymentGatewayProduct.php
        $product = SubscriptionPaymentProduct::query()
            ->where('package_id', $package_id)
            ->where('is_active', 1)
            ->where('gateway', 'stripe')
            ->first();

        if (!$product) {

            flashMessage(localize('Subscription Product and Plan not created for this Payment Gateway(Stripe)'),"error");
            wLog("Failed to subscribe to Stripe Gateway",[],logService()::LOG_STRIPE);

            return redirect()->back();
        }

        if (paymentGateway('stripe')?->is_active != 1) {

            abort(404);
        }

        self::cashierConfig();

        $stripe = self::initStripeClient();

        $user                    = user();
        $currentCustomerIdsArray = [];

        foreach ($stripe->customers->all()->data as $data) {
            $currentCustomerIdsArray[] = $data->id;
        }

        if (in_array($user->stripe_id, $currentCustomerIdsArray) == false) {

            $userData = [
                "email" => $user->email,
                "name"  => $user->name,
                "phone" => $user->phone,
                "address" => [
                    "line1"       => @$user->address ?? null,
                    "postal_code" => @$user->postal ?? null,
                ],
            ];

            $stripeCustomer = $stripe->customers->create($userData);
            $user->stripe_id = $stripeCustomer->id;
            $user->save();
        }


        $email               = $user->email;
        $activeSubscriptions = $user->subscriptions()->where('stripe_status', 'active')->orWhere('stripe_status', 'trialing')->get();
        $paymentIntent       = null;

        try {
            $currency = self::currency();
            $price    = self::price($package->discount_status ? $package->discount_price : $package->price);
            $product  = PaymentGatewayProduct::query()->where(["package_id" => $package_id, "gateway" => "stripe"])->first();
            $package  = SubscriptionPlan::query()->find($package_id);

            $exception = $incomingException;

            if ($product != null) {
                if ($product->price_id == null) {
                    $exception = "Stripe product ID is not set! Please save Membership Plan again.";
                } else {

                    $subscriptionInfo = [
                        'customer' => $user->stripe_id,
                        'items' => [[
                            'price' => $product->price_id,
                        ]],
                        'payment_behavior' => 'default_incomplete',
                        'payment_settings' => ['save_default_payment_method' => 'on_subscription'],
                        'expand' => ['latest_invoice.payment_intent'],
                        'metadata' => [
                            'product_id' => $product->product_id,
                            'price_id' => $product->price_id,
                            'plan_id' => $package_id
                        ],
                    ];


                    // Create the subscription with the customer ID, price ID, and necessary options.
                    $newSubscription = $stripe->subscriptions->create($subscriptionInfo);

                    //Log::info('StripeController::subscribe() - newSubscription: ' . json_encode($newSubscription));

                    $subscription = new SubscriptionsModel();
                    $subscription->user_id        = $user->id;
                    $subscription->name           = $package_id;
                    $subscription->stripe_id      = $newSubscription->id;
                    $subscription->stripe_status  = "AwaitingPayment"; // $plan->trial_days != 0 ? "trialing" : "AwaitingPayment";
                    $subscription->stripe_price   = $product->price_id;
                    $subscription->quantity       = 1;
                    $subscription->package_id     = $package_id;
                    $subscription->payment_method = 'stripe';
                    $subscription->save();

                    $subscriptionItem = new SubscriptionItems();
                    $subscriptionItem->subscription_id = $subscription->id;
                    $subscriptionItem->stripe_id       = $newSubscription->items->data[0]->id;
                    $subscriptionItem->stripe_product  = $product->product_id;
                    $subscriptionItem->stripe_price    = $product->price_id;
                    $subscriptionItem->quantity        = 1;
                    $subscriptionItem->save();

                    $paymentIntent = [
                        'subscription_id' => $newSubscription->id,
                        'client_secret'   => $newSubscription->latest_invoice->payment_intent->client_secret,
                        'trial'           => false,
                        'currency'        => self::currencyCode(),
                        'amount'          => $price * 100,
                    ];
                }
            } else {
                $exception = "Stripe product is not defined! Please save Membership Plan again.";
            }
        } catch (\Exception $th) {
            // $exception = $th;
            Log::error('stripe pay'.$th->getMessage());
            $exception = Str::before($th->getMessage(), ':');

            ddError($th,["exception"=>$exception]);
        }

        return view('payments.autoRecurring.srtipe', compact('package', 'paymentIntent','exception', 'activeSubscriptions', 'product', 'email'));
    }
    /**
     * Handles payment action of Stripe.
     * 
     * Subscribe payment page posts here.
     */
    public function subscribePay(Request $request)
    {
        Log::info('- request: ' . json_encode($request->all()));

        if ($request->has('payment_intent') && $request->has('payment_intent_client_secret') && $request->has('redirect_status')) {

            $payment_intent = $request->input('payment_intent');
            $payment_intent_client_secret = $request->input('payment_intent_client_secret');
            $redirect_status = $request->input('redirect_status');

            if ($redirect_status == "succeeded") {

                if (paymentGateway('stripe')?->is_active != 1) {
                    abort(404);
                }
                self::cashierConfig();
                $stripe = self::initStripeClient();

                $user = auth()->user();
                $intent = $stripe->paymentIntents->retrieve($payment_intent);

                //Log::info('- intent: ' . json_encode($intent));

                if ($intent != null) {

                    if ($intent->client_secret == $payment_intent_client_secret) {

                        if ($intent->status == "succeeded") {

                            $user = Auth::user();

                            // self::cancelAllSubscriptions();

                            $subscription = SubscriptionsModel::where(['user_id' => $user->id, 'stripe_status' => "AwaitingPayment"])->latest()->first();

                            $package_id = $subscription->package_id;
                            $package = SubscriptionPlan::where('id', $package_id)->first();

                            $subscription->stripe_status = "active";
                            $subscription->save();


                            //check if any other "AwaitingPayment" subscription exists if so cancel it
                            $awaitingPaymentSubscriptions = SubscriptionsModel::where(['user_id' => $user->id, 'stripe_status' => "AwaitingPayment"])->get();
                            if ($awaitingPaymentSubscriptions != null) {
                                foreach ($awaitingPaymentSubscriptions as $subs) {
                                    if ($subs->stripe_id != 'undefined' && $subs->stripe_id != null && $subs->user_id == $user->id) {
                                        try {
                                            $subscription = $stripe->subscriptions->retrieve($subs->stripe_id);
                                        } catch (\Exception $ex) {
                                            $subscription = null;
                                            error_log("n" . $ex->getMessage());
                                        }

                                        if ($subscription != null) {
                                            $subscription->delete();
                                        }
                                        $subs->stripe_status = "cancelled";
                                        $subs->save();
                                    }
                                }
                            }

                            try {
                                $data = [
                                    'billing_id' => $request->billingPlanId,
                                    'product_id' => $request->productId,
                                    'gateway_subscription_id' => $request->paypalSubscriptionID,
                                    'json' => false,
                                    'gateway'=>'stripe'
                                ];

                                $amount = self::currencyAmount();
                                $paymentController =   new PaymentsController;
                                return $paymentController->payment_success(null, null, $package_id, $amount/100, 'stripe', $data);
                            } catch (Throwable $ex) {
                                Log::info('error stripe payment' . $ex->getMessage());
                                return (new PaymentsController)->payment_failed();
                            }
                        } else {
                            Log::error('intent->status != succeeded');
                            return (new PaymentsController)->payment_failed();
                        }
                    } else {
                        Log::error('- intent->client_secret != $payment_intent_client_secret');
                        //Falsified data
                        abort(404);
                    }
                } else {
                    //Falsified data
                    abort(404);
                }
            } else {
                return back()->with(['message' => "A problem occured! $redirect_status", 'type' => 'error']);
            }
        } else if ($request->has('setup_intent') && $request->has('setup_intent_client_secret') && $request->has('redirect_status')) {

            $setup_intent = $request->input('setup_intent');
            $setup_intent_client_secret = $request->input('setup_intent_client_secret');
            $redirect_status = $request->input('redirect_status');

            if ($redirect_status == "succeeded") {
                self::cashierConfig();
                $stripe = self::initStripeClient();

                $intent = $stripe->setupIntents->retrieve($setup_intent);

                Log::info('- intent: ' . json_encode($intent));

                if ($intent != null) {

                    if ($intent->client_secret == $setup_intent_client_secret) {

                        if ($intent->status == "succeeded") {

                            $user = Auth::user();

                            // self::cancelAllSubscriptions();

                            $subscription = SubscriptionsModel::where(['user_id' => $user->id, 'stripe_status' => "AwaitingPayment"])->latest()->first();

                            $package_id = $subscription->package_id;
                            $package = SubscriptionPlan::where('id', $package_id)->first();

                            $subscription->stripe_status = "active";
                            $subscription->save();



                            //check if any other "AwaitingPayment" subscription exists if so cancel it
                            $awaitingPaymentSubscriptions = SubscriptionsModel::where(['user_id' => $user->id, 'stripe_status' => "AwaitingPayment"])->get();
                            if ($awaitingPaymentSubscriptions != null) {
                                foreach ($awaitingPaymentSubscriptions as $subs) {
                                    if ($subs->stripe_id != 'undefined' && $subs->stripe_id != null && $subs->user_id == $user->id) {
                                        try {
                                            $subscription = $stripe->subscriptions->retrieve($subs->stripe_id);
                                        } catch (\Exception $ex) {
                                            $subscription = null;
                                            error_log("n" . $ex->getMessage());
                                        }

                                        if ($subscription != null) {
                                            $subscription->delete();
                                        }
                                        $subs->stripe_status = "cancelled";
                                        $subs->save();
                                    }
                                }
                            }
                            try {
                                $data = [
                                    'billing_id' => $request->billingPlanId,
                                    'product_id' => $request->productId,
                                    'gateway_subscription_id' => $request->paypalSubscriptionID,
                                    'json' => true
                                ];

                                $amount = self::currencyAmount();
                                $paymentController =   new PaymentsController;
                                return $paymentController->payment_success(null, null, $package_id, $amount/100, 'stripe', $data);
                            } catch (Throwable $ex) {
                                Log::info('error stripe payment' . $ex->getMessage());
                                return (new PaymentsController)->payment_failed();
                            }
                        } else {
                            Log::error('- intent->status != succeeded');
                            return (new PaymentsController)->payment_failed();
                        }
                    } else {
                        Log::error('- intent->client_secret != $payment_intent_client_secret');
                        //Falsified data
                        abort(404);
                    }
                } else {
                    //Falsified data
                    abort(404);
                }
            } else {
                return (new PaymentsController)->payment_failed();
            }
        } else {
            abort(404);
        }
    }
    /**
     * Cancels current subscription plan
     */
    public static function cancelSubscription()
    {
        if (paymentGateway('stripe')?->is_active != 1) {
            abort(404);
        }
        self::cashierConfig();
        $stripe = self::initStripeClient();

        $user = auth()->user();

        $activeSubscription = $user->subscriptions()->where('stripe_status', 'active')->orWhere('stripe_status', 'trialing')->first();

        $subscription = $stripe->subscriptions->retrieve($activeSubscription->stripe_id);
        $subscription->delete();
  
        return true;
    }

    /**
     * This function is stripe specific.
     */
    public function cancelAllSubscriptions()
    {
        if (paymentGateway('stripe')?->is_active != 1) {
            abort(404);
        }
        self::cashierConfig();
        $stripe = self::initStripeClient();

        $product = null;

        $user = Auth::user();

        //$allSubscriptions = $user->subscriptions()->where('stripe_status', 'active')->orWhere('stripe_status', 'trialing')->all();
        $allSubscriptions = SubscriptionsModel::where(['user_id' => $user->id, 'stripe_status' => "active"])->get();
        if ($allSubscriptions != null) {
            foreach ($allSubscriptions as $subs) {
                if ($subs->stripe_id != 'undefined' && $subs->stripe_id != null && $subs->user_id == $user->id) {
                    // $user->subscription($subs->stripe_id)->cancelNow();
                    try {
                        $subscription = $stripe->subscriptions->retrieve($subs->stripe_id);
                    } catch (\Exception $ex) {
                        $subscription = null;
                        error_log("StripeController::cancelAllSubscriptions()\n" . $ex->getMessage());
                        //return back()->with(['message' => 'Could not find active subscription. Nothing changed!', 'type' => 'error']);
                    }

                    if ($subscription != null) {
                        $subscription->delete();
                    }
                }
            }
        }

        $allSubscriptions = SubscriptionsModel::where(['user_id' => $user->id, 'stripe_status' => "trialing"])->get();
        if ($allSubscriptions != null) {
            foreach ($allSubscriptions as $subs) {
                if ($subs->stripe_id != 'undefined' && $subs->stripe_id != null && $subs->user_id == $user->id) {
                    // $user->subscription($subs->stripe_id)->cancelNow();
                    try {
                        $subscription = $stripe->subscriptions->retrieve($subs->stripe_id);
                    } catch (\Exception $ex) {
                        $subscription = null;
                        error_log("StripeController::cancelAllSubscriptions()\n" . $ex->getMessage());
                        //return back()->with(['message' => 'Could not find active subscription. Nothing changed!', 'type' => 'error']);
                    }

                    if ($subscription != null) {
                        $subscription->delete();
                    }
                }
            }
        }
    }
    /**
     * Displays Payment Page of Stripe gateway for prepaid plans.
     */
    public static function prepaid($package_id, $package, $incomingException = null)
    {
        if (paymentGateway('stripe')?->is_active != 1) {
            abort(404);
        }
        self::cashierConfig();
        $stripe              = self::initStripeClient();
        $user                = auth()->user();
        $activeSubscriptions = $user->subscriptions()->where('stripe_status', 'active')->orWhere('stripe_status', 'trialing')->get();
        $paymentIntent       = null;
        $currency            = self::currency();
        $price               = self::price($package->discount_status ? $package->discount_price : $package->price);
        $product             = PaymentGatewayProduct::where(["package_id" => $package_id, "gateway" => "stripe"])->first();
        $package             = SubscriptionPlan::where('id', $package_id)->first();

        try {
            $exception = $incomingException;
            if ($product != null) {
                if ($product->price_id == null) {
                    $exception = "Stripe product ID is not set! Please save Membership Plan again.";
                } else {

                    // Create a PaymentIntent with amount and currency
                    $paymentIntent = \Stripe\PaymentIntent::create([
                        'amount' => $price * 100,
                        'currency' => $currency,
                        'automatic_payment_methods' => [
                            'enabled' => true,
                        ],
                        'metadata' => [
                            'product_id' => $product->product_id,
                            'price_id' => $product->price_id,
                            'plan_id' => $package_id
                        ],
                    ]);
                }
            } else {
                $exception = "Stripe product is not defined! Please save Membership Plan again.";
            }
        } catch (\Exception $th) {
            $exception = Str::before($th->getMessage(), ':');
        }

        return view('panel.user.payment.prepaid.payWithStripeElements', compact('plan', 'paymentIntent', 'gateway', 'exception', 'activesubs', 'product', 'email'));
    }
    public static function cancelSubscribedPlan($package_id, $subsId)
    {
        try {
            $user = auth()->user();
            $user->subscription($package_id)->cancelNow();
            $user->save();
            return true;
        } catch (\Exception $th) {
            Log::info($th->getMessage());
            return false;
        }
    }


    # create of product
    public static function createProduct($package_id)
    {
        try {
            //code...
            if (paymentGateway('stripe')?->is_active != 1) {
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
            $interval = null;
            if ($package->package_type == 'monthly') {
                $interval = 'month';
            } elseif ($package->package_type) {
                $interval = 'year';
            }

            $user = auth()->user();
            $data = [
                "name"          => $package->title,
                "description"   => $package->description
            ];

            $oldProductId = null;
            $price        = self::price($package->discount_status ? $package->discount_price : $package->price);
            $currency     = self::currency();
         
            $paymentGatewayProduct = SubscriptionPaymentProduct::where('package_id', $package_id)->where('is_active', 1)->where('gateway', 'stripe')->first();
            $stripe = self::initStripeClient();
            if ($paymentGatewayProduct) {

                if ($paymentGatewayProduct->product_id != null && $package->title != null) {
                    //Product has been created before
                    $oldProductId = $paymentGatewayProduct->product_id;
                } else {
                    //Product has not been created before but record exists. Create new product and update record.
                }
                $oldProductId = $paymentGatewayProduct->product_id ?? null;

                $newProduct = $stripe->products->create($data);
                $paymentGatewayProduct->product_id = $newProduct->id;
                $paymentGatewayProduct->save();

                $product = $paymentGatewayProduct;
            } else {

                $newProduct =  $stripe->products->create($data);

                $product = new SubscriptionPaymentProduct();
                $product->package_id = $package_id;
                $product->package_name = $package->title;
                $product->gateway = "stripe";
                $product->user_id = $user->id;
                $product->product_id = $newProduct->id;
                $product->save();
            }
            //check if price exists
            if ($product->price_id != null) {
                //Price exists
                // Since stripe api does not allow to update recurring values, we deactivate all prices added to this product before and add a new price object.

                // Deactivate all prices
                foreach ($stripe->prices->all(['product' => $product->product_id]) as $oldPrice) {
                    $stripe->prices->update($oldPrice->id, ['active' => false]);
                }

                // One-Time price
                if ($type == "one-time") {
                    $updatedPrice = $stripe->prices->create([
                        'unit_amount' => $price,
                        'currency' => self::currency(),
                        'product' => $product->product_id,
                    ]);
                    $product->price_id = $updatedPrice->id;
                    $product->save();
                } else {
                    // Subscription

                    $oldPriceId = $product->price_id;

                    $updatedPrice = $stripe->prices->create([
                        'unit_amount' => $price,
                        'currency' => self::currency(),
                        'recurring' => ['interval' => $interval],
                        'product' => $product->product_id,
                    ]);
                    $product->price_id = $updatedPrice->id;
                    $product->save();

                    # store to old data log
                    $history = new PaymentgatewayProductHistory();
                    $history->package_id = $package_id;
                    $history->package_name = $package->title;
                    $history->gateway = 'paypal';
                    $history->old_product_id = $oldProductId;
                    $history->old_billing_id = $oldPriceId;
                    $history->new_billing_id = $updatedPrice->id;
                    $history->is_active = 0;
                    $history->save();

                    $tmp = self::updateUserData();
                }
            } else {
                // One-Time price
                if ($type == "one-time") {
                    $updatedPrice = $stripe->prices->create([
                        'unit_amount' => $price,
                        'currency' => $currency,
                        'product' => $product->product_id,
                    ]);
                  
                    $product->price_id = $updatedPrice->id;
                    $product->save();
                } else {
                    // Subscription
                    $updatedPrice = $stripe->prices->create([
                        'unit_amount' => $price,
                        'currency' => $currency,
                        'recurring' => ['interval' => $interval],
                        'product' => $product->product_id,
                    ]);
                    $product->price_id = $updatedPrice->id;
                    $product->save();
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    # update of product
    public static function updateProduct($name = 'Gold Plan')
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripe->products->create(['name' => 'Gold Plan']);
    }
    #list of products
    public static function listProducts()
    {
        $provider   = self::initStripeClient();
        $products   = $provider->products->all();
        return $products;
    }
    # create plan
    public static function createPlan($package)
    {
        $stripe = self::initStripeClient();
        $stripe->plans->create([
            'amount' => 10,
            'currency' => 'usd',
            'interval' => 'month',
            'product' => 'prod_PsGMgI0DxWiVKK',
        ]);
    }
    # update plan
    public static function updatePlan($plan_id, $package)
    {
        $stripe = self::initStripeClient();
        $stripe->plans->update(
            $plan_id,
            ['metadata' => ['order_id' => '6735']]
        );
    }
    # retrieve plan
    public static function retrievePlan($plan_id)
    {
        $stripe = self::initStripeClient();
        $stripe->plans->retrieve($plan_id, []);
    }
    # list of plans
    public static function listPlans()
    {
        $provider = self::initStripeClient();
        $plans = $provider->plans->all();
        return $plans;
    }

    # create price
    public function createPrice()
    {
        $stripe = self::initStripeClient();
        $stripe->prices->create([
            'currency' => 'usd',
            'unit_amount' => 1000,
            'recurring' => [
                'interval' => 'month'
            ],
            'product_data' => [
                'name' => 'Gold Plan'
            ],
        ]);
    }

    # update  price
    public function updatePrice()
    {
        $stripe = self::initStripeClient();
        $stripe->prices->update(
            'price_1MoBy5LkdIwHu7ixZhnattbh',
            ['metadata' => ['order_id' => '6735']]
        );
    }
    # retrieve price
    public function retrievePrice()
    {
        $stripe = self::initStripeClient();
        $stripe->prices->retrieve('price_1MoBy5LkdIwHu7ixZhnattbh', []);
    }
    # update  price
    public function listsPrice()
    {
        $stripe = self::initStripeClient();
        $stripe->prices->all(['limit' => 3]);
    }
    # search  price
    public function searchPrice()
    {
        $stripe = self::initStripeClient();
        $stripe->prices->search([
            'query' => 'active:\'true\' AND metadata[\'order_id\']:\'6735\'',
        ]);
    }
    # create subscription
    public static function createSubscription()
    {
        $stripe = self::initStripeClient();
        $stripe->subscriptions->create([
            'customer' => 'cus_Na6dX7aXxi11N4',
            'items' => [['price' => 'price_1MowQULkdIwHu7ixraBm864M']],
        ]);
    }
    # update subscription
    public static function updateSubscription()
    {
        $stripe = self::initStripeClient();
        $stripe->subscriptions->update(
            'sub_1MowQVLkdIwHu7ixeRlqHVzs',
            ['metadata' => ['order_id' => '6735']]
        );
    }
    # cancel subscriptions
    public static function cancelSubscriptions()
    {
        $stripe = self::initStripeClient();
        $stripe->subscriptions->cancel('sub_1MlPf9LkdIwHu7ixB6VIYRyX', []);
    }
    # all subscriptions
    public function listSubscriptions()
    {
        $stripe = self::initStripeClient();
        return $stripe->subscriptions->all(['limit' => 3]);
    }
    /**
     * Checks status directly from gateway and updates database if cancelled or suspended.
     */
    public static function getSubscriptionStatus($incomingUserId = null)
    {

        // $plan = PaymentPlans::find($request->plan);
        if ($incomingUserId != null) {
            $user = User::where('id', $incomingUserId)->first();
        } else {
            $user = Auth::user();
        }
        if (paymentGateway('stripe')?->is_active != 1) {
            abort(404);
        }
        self::cashierConfig();
        $stripe = self::initStripeClient();
        $sub = $user->subscriptions()->where('stripe_status', 'active')->orWhere('stripe_status', 'trialing')->first();
        if ($sub != null) {
            if ($sub->paid_with == 'stripe') {
                $activeSub = $sub->asStripeSubscription();

                if ($activeSub->status == 'active' or $activeSub->status == 'trialing') {
                    return true;
                } else {
                    $activeSub->stripe_status = 'cancelled';
                    $activeSub->ends_at = \Carbon\Carbon::now();
                    $activeSub->save();
                    return false;
                }
            }
        }

        return false;
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
    public static function currencyAmount()
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

        return $amount = number_format((float)$amount, 2, '.', '')  * 100;
    }
    public static function price($amount)
    {
        return number_format((float)$amount, 2, '.', '')  * 100;
    }
    public static function currency($currency = null)
    {
        return $currency ?? 'usd';
    }
    /**
     * Since price id is changed, we must update user data, i.e cancel current subscriptions.
     */
    public static function updateUserData()
    {

        try {
            $history = OldSubscriptionPaymentProduct::where([
                "gateway" => 'stripe',
                "status" => 'check'
            ])->get();

            if ($history != null) {

                $user = auth()->user();

                if (paymentGateway('stripe')?->is_active != 1) {
                    abort(404);
                }

                $key = null;


                $stripe = self::initStripeClient();

                foreach ($history as $record) {

                    // check record current status from gateway
                    $lookingFor = $record->old_billing_id;

                    // if active disable it
                    if ($lookingFor != 'undefined') {
                        $stripe->prices->update($lookingFor, ['active' => false]);
                    }

                    // // search subscriptions for record
                    // $subs = SubscriptionsModel::where([
                    //     'stripe_status' => 'active',
                    //     'stripe_price'  => $lookingFor
                    // ])->get();

                    // if ($subs != null) {
                    //     foreach ($subs as $sub) {
                    //         // cancel subscription order from gateway
                    //         $user->subscription($sub->name)->cancelNow();

                    //         // cancel subscription from our database
                    //         $sub->stripe_status = 'cancelled';
                    //         $sub->ends_at = \Carbon\Carbon::now();
                    //         $sub->save();
                    //     }
                    // }

                    // $record->status = 'checked';
                    // $record->save();
                }
            }
        } catch (\Exception $th) {
            Log::info("StripeController::updateUserData(): " . $th->getMessage());
            return ["result" => Str::before($th->getMessage(), ':')];
            // return Str::before($th->getMessage(),':');
        }
    }


    function verifyIncomingJson(Request $request)
    {

        $webhook_secret = paymentGatewayValue('stripe', 'webhook_secret');
        if (isset($currencywebhook_secret)) {
            $secret = $currencywebhook_secret;
            if (Str::startsWith($secret, 'whsec') == true) {
                $endpoint_secret = $secret;

                if ($request->hasHeader('stripe-signature') == true) {
                    $sig_header = $request->header('stripe-signature');
                } else {
                    Log::error('(Webhooks) StripeController::verifyIncomingJson() -> Invalid header');
                    return null;
                }

                $payload = $request->getContent();
                $event = null;

                try {
                    $event = \Stripe\Webhook::constructEvent(
                        $payload,
                        $sig_header,
                        $endpoint_secret
                    );
                    return json_encode($event);
                } catch (\UnexpectedValueException $e) {
                    // Invalid payload
                    Log::error('(Webhooks) StripeController::verifyIncomingJson() -> Invalid payload : ' . $payload);
                    return null;
                } catch (\Stripe\Exception\SignatureVerificationException $e) {
                    // Invalid signature
                    Log::error('(Webhooks) StripeController::verifyIncomingJson() -> Invalid signature : ' . $payload);
                    return null;
                }
            }
        }

        return null;
    }


    public function handleWebhook(Request $request)
    {

        // Log::info($request->getContent());
        // $verified = $request->getContent();

        $verified = self::verifyIncomingJson($request);

        if ($verified != null) {

            // Retrieve the JSON payload
            $payload = $verified;

            // Fire the event with the payload
            event(new StripeWebhookEvent($payload));

            return response()->json(['success' => true]);
        } else {
            // Incoming json is NOT verified
            abort(404);
        }
    }


    public static function createWebhook()
    {

        try {
            if (paymentGateway('stripe')?->is_active != 1) {
                abort(404);
            }
            $stripe = self::initStripeClient();
            $webhooks = $stripe->webhookEndpoints->all();
            $gateway = PaymentGateway::where('gateway', 'stripe')->first();
            if (count($webhooks['data']) > 0) {
                // There is/are webhook(s) defined. Remove existing.
                foreach ($webhooks['data'] as $hook) {
                    $tmp = json_decode($stripe->webhookEndpoints->delete($hook->id, []));
                    if (isset($tmp->deleted)) {
                        if ($tmp->deleted == false) {
                            Log::error('Webhook ' . $hook->id . ' could not deleted.');
                        }
                    } else {
                        Log::error('Webhook ' . $hook->id . ' could not deleted.');
                    }
                }
            }

            // Create new webhook

            $url = url('/') . '/webhooks/stripe';

            $events = [
                'invoice.paid',                     // A payment is made on a subscription.
                'customer.subscription.deleted'     // A subscription is cancelled.
            ];

            $response = $stripe->webhookEndpoints->create([
                'url' => $url,
                'enabled_events' => $events,
            ]);

            $gateway->webhook_id = $response->id;
            $gateway->webhook_secret = $response->secret;
            $gateway->save();
        } catch (AuthenticationException $th) {
            Log::info("StripeController::createWebhook(): " . $th->getMessage());
            return back()->with(['message' => "Stripe Authentication Error. Invalid API Key provided.", 'type' => 'error']);
        } catch (InvalidArgumentException $th) {
            Log::info("StripeController::createWebhook(): " . $th->getMessage());
            return back()->with(['message' => "You must provide Stripe API Key.", 'type' => 'error']);
        } catch (\Exception $th) {
            Log::info("StripeController::createWebhook(): " . $th->getMessage());
            return back()->with(['message' => "Stripe Error : " . $th->getMessage(), 'type' => 'error']);
        }
    }
    public static function showPlanDetails($product_id)
    {
        $stripe = self::initStripeClient();
       return $product = $stripe->prices->retrieve($product_id);
    }
}
