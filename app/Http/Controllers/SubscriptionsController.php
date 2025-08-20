<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Payments\PaymentsController;
use App\Models\PaymentGateway;
use App\Models\SubscriptionPlan;
use App\Traits\SubscribePlanTrait;
use Illuminate\Support\Facades\DB;

class SubscriptionsController extends Controller
{
    use SubscribePlanTrait;
    #index
    public function index()
    {
        //return redirect()->route('subscriptions.index');
    }
    # subscribe

    public function subscribe(Request $request)
    {
        try{
            DB::beginTransaction();

            if (!$request->isMethod('post')) {
                return redirect()->back();
            }

            $plan = SubscriptionPlan::query()->where('id', $request->package_id)->first();

            if(empty($plan)) {
                flash(localize('Subscription plan not found'))->error();

                return redirect()->back();
            }

            $paymentGateway = PaymentGateway::query()->where('id', $request->payment_method)->first();

            // Check Payment method
            if(empty($paymentGateway)){
                throw new \RuntimeException(localize('Payment method not found'),requestResponse()::BAD_REQUEST);
            }

            // Offline Payment Method
            if ($paymentGateway->gateway == appStatic()::OFFLINE_PAYMENT_METHOD) {

                $request['is_offline'] = true;
                $data                  = $this->storeSubscriptionUser($request);

                DB::commit();

                flashMessage(localize('Operation successfully. Please Wait For Approval'));
                return redirect()->route('admin.subscription-plans.index');
            }


            $active_now = true;

            $request->session()->put('package_id', $request->package_id);

            $request->session()->put('amount', formatPrice(packageSellPrice($request->package_id), false, false, false, false));

            $request->session()->put('request_amount', formatPrice($request->offline_amount, false, false, false, false));

            $request->session()->put('payment_method', $paymentGateway->gateway);

            $request->session()->put('active_now', $active_now);

            DB::commit();

            # init payment
            try {

                $payment = new PaymentsController;
                return $payment->initPayment();

            } catch (\Throwable $th) {
                throw new \RuntimeException($th->getMessage(),appStatic()::INTERNAL_ERROR);
            }
        }
        catch(\Throwable $e){
            DB::rollBack();

            ddError($e);


            wLog("Failed to subscribe subscription", errorArray($e));

            flashMessage($th->getMessage(),"error");

            return redirect()->back();
        }




    }
    public function offlinePayment($request)
    {
        $package = SubscriptionPlan::where('id', $request->package_id)->first();
    }
}

