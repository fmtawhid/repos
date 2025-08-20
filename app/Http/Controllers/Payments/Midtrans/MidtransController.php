<?php

namespace App\Http\Controllers\Payments\Midtrans;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GrassPeriodPayment;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\PaymentsController;
use App\Models\SubscriptionHistory;

class MidtransController extends Controller
{
    # init payment
    public function initPayment()
    {
        $user = auth()->user();
        $amount = session('amount');

        try {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction =  paymentGateway('midtrans')?->sandbox == 1 ? false : true;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            \Midtrans\Config::$appendNotifUrl  = route('midtrans.payment-notification');


            $order_id = Str::random(10);
            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_id,
                    'gross_amount' => round($amount),
                ),
                'customer_details' => array(
                    'first_name' => auth()->user()->name,
                    'last_name' => '',
                    'phone' => auth()->user()->phone ?? '',
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return view('payments.midtrans', compact('snapToken'));
        } catch (\Exception $e) {

            return (new PaymentsController)->payment_failed();
        }
    }

    # callback  
    public function callback(Request $request)
    {
        try {
            $notification_body = json_decode($request->getContent());
            Log::info('callback notification :' . $notification_body);
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            $notif = new \Midtrans\Notification();
            Log::info('callback notify notification :' . $notif);
            Log::info('callback notify request :' . $request->all());
        } catch (\Exception $e) {
            Log::info('midtranse notification :' . $e->getMessage());
        }
        $transaction_status =  'capture';
        if ($transaction_status == 'capture') {
            $payment = ["status" => "Success"];
            return (new PaymentsController)->payment_success(json_encode($payment));
        } else {
            return (new PaymentsController)->payment_failed();
        }
    }

    # successful payment
    public function success(Request $request)
    {
        try {

            $transaction_status = $request->transaction_status;
            $order_id = $request->order_id;
            $status_code = $request->status_code;
            $user = auth()->user();

            if (!$transaction_status && $order_id && $status_code) {
                return (new PaymentsController)->payment_failed();
            }
            // config midtranse
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');

            $transaction = \Midtrans\Transaction::status($order_id);

            if (!$transaction) {
                return (new PaymentsController)->payment_failed();
            }
            $this->storeGrassPeriod($order_id, $transaction->transaction_status, $status_code, $transaction);

            if ($transaction->transaction_status == 'success' || $transaction->transaction_status == 'capture' || $transaction->transaction_status == 'settlement') {
                $payment = ["status" => "Success"];
                return (new PaymentsController)->payment_success(json_encode($payment));
            } elseif ($transaction->transaction_status == 'pending') {
                $data = [
                    'status' => 'info',
                    'message' => localize('Waiting your payment!')
                ];
                flash(localize('Waiting your payment!'))->info();
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return (new PaymentsController)->payment_failed();
        }
    }

    # cancelled
    public function cancel()
    {
        return (new PaymentsController)->payment_failed();
    }

    # cancelled
    public function failed()
    {
        return (new PaymentsController)->payment_failed();
    }

    public function paymentNotification(Request $request)
    {
        try {

         
            \Midtrans\Config::$isProduction =  paymentGateway('midtrans')?->sandbox == 1 ? false : true;
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            $notification = new \Midtrans\Notification();
            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $order_id = $notification->order_id;
            $fraud = $notification->fraud_status;

            $data = [
                'json' => true,
                'order_id'=>$order_id
            ];
            $pendingRecord = GrassPeriodPayment::where('order_id', $order_id)->where('transaction_status', 'pending')->first();
            $user  = User::where('id', $pendingRecord->user_id)->first();
            
            $subscription_history = SubscriptionHistory::where('user_id', $user->id)->where('order_id', $order_id)->first();

            if ($transaction == 'capture' && $pendingRecord && is_null($subscription_history)) {
                if ($type == 'credit_card') {
                    if ($fraud == 'accept') {
                        return (new PaymentsController)->payment_success(null, $user, $pendingRecord->subscription_package_id, $pendingRecord->subscriptionPackage->price, 'midtrans', $data);
                    }
                }
            } else if ($transaction == 'settlement' && $pendingRecord && is_null($subscription_history)) {                  
                return (new PaymentsController)->payment_success(null, $user, $pendingRecord->subscription_package_id, $pendingRecord->subscriptionPackage->price, 'midtrans', $data);
            } else if ($transaction == 'pending' && $pendingRecord) {
                // no need

            } else if ($transaction == 'deny' && $pendingRecord && is_null($subscription_history)) {
                $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
                Log::info('Midtrans deny' . $message);
            } else if ($transaction == 'expire' && $pendingRecord && is_null($subscription_history)) {
                $pendingRecord->delete();
            } else if ($transaction == 'cancel' && $pendingRecord && is_null($subscription_history)) {
                // Cancel
            }
        } catch (\Exception $e) {
            Log::info('Midtrans notification error:' . $e->getMessage());
        }
    }
    # recurring notification
    public function recurringNotification(Request $request)
    {
        Log::info('Midtrans recurring Notification:' . $request);
    }
        # pay account notification
    public function payAccountNotification(Request $request)
    {
        Log::info('Midtrans Pay Account Notification:' . $request);
    }
        # store Grass period
    private function storeGrassPeriod($order_id, $transaction_status, $status_code, $response)
    {
        GrassPeriodPayment::updateOrCreate(
            [
                'order_id'=>$order_id,
                'user_id' => auth()->user()->id,
                'subscription_package_id' => session('package_id'),
            ],
            [
                'transaction_status' => $transaction_status,
                'status_code' => $status_code,
                'response' => $response,
                'gateway'=> 'Midtrans'
            ]
        );
    }

    public function paymentPending()
    {
        $user = auth()->user();
        $payment_requests = GrassPeriodPayment::when($user->user_type != 'admin', function($q) use($user){
                $q->where('user_id', $user->id);
        })->where('user_id', $user->id)->paginate(maxPaginateNo());
        return view('backend.admin.subscriptions.gross_period_payment_pending', compact('payment_requests'));
    }
}
