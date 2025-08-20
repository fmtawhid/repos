<?php

namespace App\Services\Model\PaymentGateway;

use App\Models\SystemSetting;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayDetail;
use Illuminate\Support\Facades\Cache;

class PaymentGatewayService
{

    public function index(): array
    {
        $data = [];
        $data['paymentGateways'] = $this->paymentGateways();
        return $data;
    }
    public function updateGatewayDetails($request)
    {
        $gateway = $request->payment_method;
        $paymentGateway = PaymentGateway::where('gateway', $gateway)->first();

        if ($paymentGateway) {
            $types = $request->types;

            if(is_array($types)){
                foreach ($types as $key => $value) {

                    PaymentGatewayDetail::query()->updateOrCreate(
                        [
                            'payment_gateway_id' => $paymentGateway->id,
                            'key' => $key
                        ],
                        [
                            'value' => $value
                        ]
                    );
                    writeToEnvFile($key, $value);
                }
            }else{
                // Offline Payment Method.
                PaymentGatewayDetail::query()->updateOrCreate(
                    [
                        'payment_gateway_id' => $paymentGateway->id,
                        'key' => $request->payment_method
                    ]
                );
            }

            if ($gateway == 'paypal' && $request->payment_type) {
                writeToEnvFile('PAYPAL_MODE', $request->payment_type);
            }
            $paymentGateway->is_active = $request->is_active;
            $paymentGateway->is_recurring = $request->is_recurring;

            $paymentGateway->sandbox = $request->sandbox ? 1 : 0;
            $paymentGateway->type = $request->payment_type;

            $paymentGateway->save();
        }
       
        if ($request->has('offline_image')) {
            $setting = SystemSetting::query()->where('entity', 'offline_image')->first();
            $value = $request['offline_image'];
            if ($setting != null) {
                $setting->value = $value;
                $setting->save();
            } else {
                $setting = new SystemSetting;
                $setting->entity = 'offline_image';
                $setting->value = $value;
                $setting->save();
            }
        }

        Cache::forget('paymentGateway');
        Cache::forget('settings');

    }
    public function paymentGateways($conditions = [], $toArray = null, $is_active = null):array|object|null
    {
        $gatewayProducts = PaymentGateway::query()
        ->when($is_active, function($q) use($is_active){
            $q->where('is_active', $is_active);
        })
        ->when($conditions, function($q) use($conditions){
            $q->where($conditions);
        });

        if($toArray){
            return $gatewayProducts->pluck('subscription_plan_id')->toArray();
        }

        return $gatewayProducts->get();
    }
}
