<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\User;
use App\Models\WebhookHistory;
use App\Models\SubscriptionPlan;
use App\Events\PayPalWebhookEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\SubscriptionRecurringPayment;
use App\Http\Controllers\Payments\PaymentsController;
use App\Http\Controllers\Payments\Paypal\PaypalController;
use App\Models\SubscriptionUserUsage;

class PayPalWebhookListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    use InteractsWithQueue;
 
    public $afterCommit = true;
    public $queue = 'paypallisteners';
    # The time (seconds) before the job should be processed.
    public $delay = 5; //60
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PayPalWebhookEvent $event)
    {
        try{
            Log::info(json_encode($event->payload));
            $incomingJson = json_decode($event->payload);

            // Incoming data is verified at PaypalController handleWebhook function, which fires this event.

            $event_type = $incomingJson->event_type;
            $resource_id = $incomingJson->resource->id;
            
            // save incoming data

            $newData = new WebhookHistory();
            $newData->gateway = 'paypal';
            $newData->webhook_id = $incomingJson->id;
            $newData->create_time = $incomingJson->create_time;
            $newData->resource_type = $incomingJson->resource_type;
            $newData->event_type = $event_type;
            $newData->summary = $incomingJson->summary;
            $newData->resource_id = $resource_id;
            $newData->resource_state = isset($incomingJson->resource->state) == true ? $incomingJson->resource->state : (isset($incomingJson->resource->status) ? $incomingJson->resource->status : null);
            if($event_type == 'PAYMENT.SALE.COMPLETED'){
                $newData->parent_payment = $incomingJson->resource->parent_payment;
                $newData->amount_total = $incomingJson->resource->amount->total;
                $newData->amount_currency = $incomingJson->resource->amount->currency;
            }
            $newData->incoming_json = json_encode($incomingJson);
            $newData->status = 'check';
            $newData->save();

            // switch/check event type
            $recurringHistory = SubscriptionRecurringPayment::where('gateway_subscription_id', $resource_id)->first();
            if($event_type == 'BILLING.SUBSCRIPTION.CANCELLED'){
                // $resource_id is subscription id in this event.
                $currentSubscription = SubscriptionRecurringPayment::where('gateway_subscription_id', $resource_id)->first();
                if($currentSubscription->is_active != 0){
                    $currentSubscription->is_active = 0;
                    $currentSubscription->updated_at = Carbon::now();
                    $currentSubscription->save();
                    $newData->status = 'checked';
                    $newData->save();
                }

            }else if($event_type == 'PAYMENT.SALE.COMPLETED'){
                // $resource_id is transaction id in this event.
                // Hence we must make new request to get subscription id.

                $provider = PaypalController::getPaypalProvider();

                $filters = [
                    "transaction_id" => $resource_id,
                    'start_date'     => Carbon::now()->subDays(7)->toIso8601String(),
                    'end_date'       => Carbon::now()->addDays(2)->toIso8601String(),
                ];

                $transactionList = $provider->listTransactions($filters);
                $transactions = json_decode($transactionList);

                Log::info(json_encode($transactions));

                if(array_key_exists('error', $transactions) === false){

                    foreach ($transactions->transaction_details as $transaction) {
                        // S: The transaction successfully completed without a denial and after any pending statuses.
                        if($transaction->transaction_info->transaction_event_code == 'T0002' and $transaction->transaction_status == 'S'){

                            $amountPaidValue = $transaction->transaction_info->transaction_amount->value;
                            $amountPaidCurrency = $transaction->transaction_info->transaction_amount->currency_code;
                            $email = $transaction->payer_info->email_address;
                            $name = $transaction->payer_info->given_name;
                            $surname = $transaction->payer_info->surname;
                            $transaction_id = $transaction->transaction_info->transaction_id;

                            // We can NOT get subscription id directly, thats why we are going to make a workaround.
                            // Get user
                            $user = User::where('id', $recurringHistory->user_id)->first();
                            if($user != null){

                                $userId = $user->id;
                                # Get users active subscription

                                $activePackage  = $user->plan;
                               
                                if($activePackage != null){
                                    $activePackageSubscription = SubscriptionRecurringPayment::where('subscription_history_id', $activePackage->id)->first();
                                    # Get plan
                                    $plan = SubscriptionPlan::where('id', $activePackageSubscription->subscription_package_id)->first();

                                    if($plan != null){

                                        // Check if its price is equal to amountPaidValue.
                                        // amountPaidValue returns decimal with . (i.e. "value": "465.00" , "value": "-13.79")
                                        // we save price in plan as double (i.e. 10 , 19.9 (not 19.90))
                                        if(number_format((float)$amountPaidValue, 2, '.', '') == number_format((float)$plan->price, 2, '.', '')){

                                            // check for duplication
                                            $duplicate = false;
                                            // check for first payment in subscription
                                            if(Carbon::parse($activePackage->created_at)->diffInMinutes(Carbon::parse($incomingJson->create_time)) < 5 ){
                                                $duplicate = true;
                                            }

                                            if($duplicate == false){
                                            
                                            }else{ // active or cancelled
                                                
                                                $subscription = $provider->showSubscriptionDetails($activePackageSubscription->gateway_subscription_id);

                                                if(isset($subscription['error'])){
                                                    error_log("PaypalWebhookListener::handle() -> getSubscriptionStatus() :\n".json_encode($subscription));
                                                }else{

                                                    // check for duplication
                                                    $duplicate = false;
                                                    // check for first payment in subscription
                                                    if(Carbon::parse($activePackage->created_at)->diffInMinutes(Carbon::parse($incomingJson->create_time)) < 5 ){
                                                        $duplicate = true;
                                                    }

                                                    if($duplicate == false){

                                                        if ($subscription['status'] == 'ACTIVE'){
                                                            $payment = new PaymentsController;
                                                           try {
                                                            $history = SubscriptionUserUsage::where($recurringHistory->subscription_user_usage_id)->first();
                                                            $payment->payment_success(null,$user,$history->subscription_plan_id, $amountPaidValue, 'paypal');
                                                           } catch (\Throwable $th) {
                                                            //throw $th;
                                                           }

                                                        }else{
                                                          
                                                        }
                                                    }
                                                }

                                            }


                                        }else{
                                            Log::error("PaypalWebhookListener::handle() Error : Subscription prices do not match. || ".json_encode($transactions));
                                        }
                                    }else{
                                        Log::error("PaypalWebhookListener::handle() Error : Membership Plan Not Found || ".json_encode($transactions));
                                    }

                                }else{
                                    Log::error("PaypalWebhookListener::handle() Error : Subscription Not Found || ".json_encode($transactions));
                                }
                                
                            }else{
                                Log::error("PaypalWebhookListener::handle() Error : User Not Found || ".json_encode($transactions));
                            }

                        }
                    }

                }else{
                    Log::error("PaypalWebhookListener::handle() Error : ".$transactions->error->message);
                }


            }











            // save new order if required
            // on cancel we do not delete anything. just check if subs cancelled



        }catch(\Exception $ex){
            Log::error("PaypalWebhookListener::handle()\n".$ex->getMessage());
            error_log("PaypalWebhookListener::handle()\n".$ex->getMessage());
        }
    }
}

