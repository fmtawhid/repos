<?php

namespace App\Http\Controllers\Payments;

use App\Models\User;
use App\Models\PaymentGateway;
use App\Models\AffiliateEarning;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionUser;
use App\Models\SubscriptionHistory;
use App\Traits\SubscribePlanTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\SubscriptionUserUsage;
use App\Models\SubscriptionRecurringPayment;
use App\Http\Controllers\Payments\Duitku\DuitkuController;
use App\Http\Controllers\Payments\IyZico\IyZicoController;
use App\Http\Controllers\Payments\Paypal\PaypalController;
use App\Http\Controllers\Payments\Midtrans\MidtransController;
use App\Http\Controllers\Payments\Paystack\PaystackController;
use App\Http\Controllers\Payments\Razorpay\RazorpayController;
use App\Http\Controllers\Payments\Paytm\PaytmPaymentController;
use App\Http\Controllers\Payments\Molile\MolilePaymentController;
use App\Http\Controllers\Payments\Stripe\StripePaymentController;
use App\Http\Controllers\Payments\Flutterwave\FlutterwaveController;
use App\Http\Controllers\Payments\Yookassa\YookassaPaymentController;
use App\Http\Controllers\Payments\Mercadopago\MercadopagoPaymentController;

class PaymentsController extends Controller
{
    use SubscribePlanTrait;

    # init payment gateway
    public function initPayment()
    {
        $payment_method = session('payment_method');

        if ($payment_method == 'paypal') {
            return (new PaypalController())->initPayment();
        } else if ($payment_method == 'stripe') {
            return (new StripePaymentController())->initPayment();
        } else if ($payment_method == 'paytm') {
            return (new PaytmPaymentController())->initPayment();
        } else if ($payment_method == 'razorpay') {
            return (new RazorpayController())->initPayment();
        } else if ($payment_method == 'iyzico') {
            return (new IyZicoController)->initPayment();
        } else if ($payment_method == 'paystack') {
            return (new PaystackController)->initPayment();
        } else if ($payment_method == 'flutterwave') {
            return (new FlutterwaveController)->initPayment();
        } else if ($payment_method == 'duitku') {
            return (new DuitkuController)->initPayment();
        } else if ($payment_method == 'yookassa') {
            return (new YookassaPaymentController)->initPayment();
        } else if ($payment_method == 'molile') {
            return (new MolilePaymentController)->initPayment();
        } else if ($payment_method == 'mercadopago') {
            return (new MercadopagoPaymentController)->initPayment();
        } else if ($payment_method == 'midtrans') {
            return (new MidtransController)->initPayment();
        }

        return $this->payment_success();
    }

    # payment successful
    public function payment_success(
        $payment_details = null,
        $user_ = null,
        $plan_id_ = null,
        $amount_ = null,
        $payment_method_ = null,
        $data = []
    ) {

        try{
            \DB::beginTransaction();

            $user           = user();
            $plan_id        = $plan_id_ ?? session()->get('package_id');
            $plan           = SubscriptionPlan::query()->findOrFail($plan_id);

            // Check the plan is active or not. If not active then return error.
            if (!$plan->is_active) {

                throw new \RuntimeException(localize('Sorry! Plan is not active'), appStatic()::INTERNAL_ERROR);
            }

            $amount         = $amount_ ?? $plan->price;
            $payment_method = $payment_method_ ?? session('payment_method');


            if (!empty($data)) {
                $return_json =  isset($data['json']) ? $data['json'] : false;
                $order_id =  isset($data['order_id']) ? $data['order_id'] : null;
            }

            $paymentGateway     = PaymentGateway::query()->where('gateway', $payment_method)->first();

            if (empty($paymentGateway)) {
                throw new \RuntimeException(localize('Sorry! Payment gateway not found'), appStatic()::INTERNAL_ERROR);
            }

            $payment_gateway_id = $paymentGateway?->id;

            // Make SubscriptionUser.php and SubscriptionUserUsage.php as Plan Expire
            $this->makeExistingUserPlanExpire($user);


            // Subscription User Store
            $subscriptionUser = $this->tempSubscriptionUserStore(
                $plan_id,
                $amount,
                $payment_gateway_id,
                $payment_details,
                $user->id
            );

            // Create User Usages tracking at SubscriptionUserUsage.php
            $userUsage = $this->storeSubscriptionPlanUserUsage($subscriptionUser);

            // Update User current subscription
            $userPlan = $this->updateUserCurrentSubscriptionPlanId($subscriptionUser); // User.php

            // Update Purchasing user referred user affiliate balance as per settings
            $earning = $this->updatePurchasingUserReferredUserBalance($subscriptionUser);

            if (($payment_method == 'paypal' || $payment_method == 'stripe') && !empty($data)) {
                $data = array_merge($data, [
                    'gateway' => $data['gateway'],
                    'subscription_user_usage_id' => $userUsage->id
                ]);
                $this->recurringPaymentHistory($data);
            }

            \DB::commit();

            // Redirect to
            return to_route('admin.plan-histories.index');
        }
        catch(\Throwable $e){
            \DB::rollBack();
            wLog("Failed to payment success", errorArray($e));

            return redirect()->back();
        }
    }

    # payment failed
    public function payment_failed()
    {

    }
    # recurring payment history
    public function recurringPaymentHistory($data = [])
    {
        if(empty($data)){

            return false;
        }

        $gateway_subscription_id    = $data['gateway_subscription_id'] ?? null;
        $gateway                    = $data['gateway'] ?? null;

        if (!$gateway_subscription_id && $gateway == 'paypal') {
            return false;
        }


        $billing_id                 = $data['billing_id'] ?? null;
        $product_id                 = $data['product_id'] ?? null;
        $subscription_user_usage_id = $data['subscription_user_usage_id'] ?? null;



        $recurringHistory = new SubscriptionRecurringPayment();
        $recurringHistory->subscription_user_usage_id = $subscription_user_usage_id;
        $recurringHistory->billing_id              = $billing_id;
        $recurringHistory->product_id              = $product_id;
        $recurringHistory->gateway_subscription_id = $gateway_subscription_id;
        $recurringHistory->gateway                 = $gateway;
        $recurringHistory->user_id                 = userID();
        $recurringHistory->save();

        return $recurringHistory;

    }
}
