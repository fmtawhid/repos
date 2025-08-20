<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkoutPlan(Request $request, $stripePlan)
    {

        $subscriptionPlan = SubscriptionPlan::query()->where("stripe_plan",$stripePlan)->first();

        $queryString = "?subscription_plan_id=$subscriptionPlan->id&stripe_plan=$stripePlan";

        return $request->user()
            ->newSubscription($subscriptionPlan->stripe_product_id, $stripePlan)
            ->checkout([
                'success_url' => route('stripe.success').$queryString,
                'cancel_url' => route('stripe.cancel'),
            ]);
    }

    public function success(Request $request)
    {

    }

    public function cancel(Request $request)
    {
    }

}
