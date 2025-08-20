<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentGatewayDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentGatewaySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $gateways = [
                [
                    'name' => 'paypal',
                    'path' => 'assets/img/payments/paypal.svg'
                ],
                [
                    'name' => 'stripe',
                    'path' => 'assets/img/payments/stripe.svg'
                ],
                [
                    'name' => 'paytm',
                    'path' => 'assets/img/payments/paytm.svg'
                ],
                [
                    'name' => 'razorpay',
                    'path' => 'assets/img/payments/razorpay.svg'
                ],
                [
                    'name' => 'iyzico',
                    'path' => 'assets/img/payments/iyzico.svg'
                ],
                [
                    'name' => 'paystack',
                    'path' => 'assets/img/payments/paystack.svg'
                ],
                [
                    'name' => 'flutterwave',
                    'path' => 'assets/img/payments/fluterwave.svg'
                ],
                [
                    'name' => 'duitku',
                    'path' => 'assets/img/payments/duitku.svg'
                ],
                [
                    'name' => 'yookassa',
                    'path' => 'assets/img/payments/yoomoney.svg'
                ],
                [
                    'name' => 'molile',
                    'path' => 'assets/img/payments/mollie.svg'
                ],
                [
                    'name' => 'mercadopago',
                    'path' => 'assets/img/payments/mercado-pago.svg'
                ],
                [
                    'name' => 'midtrans',
                    'path' => 'assets/img/payments/midtrans.svg'
                ],
                [
                    'name' => 'offline',
                    'path' => 'assets/img/payments/manual_payment.png'
                ]
            ];
            foreach ($gateways as $gateway) {

                PaymentGateway::updateOrCreate([
                    'gateway' => $gateway['name']
                ], [
                    'sandbox'   => 1,
                    'is_active' => 1,
                    'type'      => 'sandbox',
                    'image'     => $gateway['path']
                ]);
            }
            $gatewayDetails = [
                "PAYPAL_CLIENT_ID",
                "PAYPAL_CLIENT_SECRET",
                "STRIPE_KEY",
                "STRIPE_SECRET", 
                "PAYTM_ENVIRONMENT",
                "PAYTM_MERCHANT_ID", 
                "PAYTM_MERCHANT_KEY", 
                "PAYTM_MERCHANT_WEBSITE", 
                "PAYTM_CHANNEL", 
                "PAYTM_INDUSTRY_TYPE",
                "RAZORPAY_KEY",
                "RAZORPAY_SECRET",
                "IYZICO_API_KEY",
                "IYZICO_SECRET_KEY",
                "PAYSTACK_PUBLIC_KEY",
                "PAYSTACK_SECRET_KEY",
                "MERCHANT_EMAIL",
                "PAYSTACK_CURRENCY_CODE",
                "FLW_PUBLIC_KEY",
                "FLW_SECRET_KEY",
                "FLW_SECRET_HASH",
                "DUITKU_API_KEY",
                "DUITKU_MERCHANT_CODE",
                "DUITKU_CALLBACK_URL",
                "DUITKU_RETURN_URL",
                "DUITKU_ENV",
                "YOOKASSA_SHOP_ID",
                "YOOKASSA_SECRET_KEY",
                "YOOKASSA_CURRENCY_CODE",
                "YOOKASSA_RECIEPT",
                "YOOKASSA_VAT",
                "MOLILE_API_KEY",
                "MERCADOPAGO_SECRET_KEY",
                "MIDTRANS_SERVER_KEY",
                "MIDTRANS_CLIENT_KEY",
    
            ];
            foreach($gatewayDetails as $detail){
                $gatewayArray = explode('_', $detail);
                $gateway = strtolower($gatewayArray[0]);
                $name = $gateway;
                if($gateway == 'flw') {
                    $name = 'flutterwave';
                }elseif($gateway == 'merchant'){
                    $name = 'paystack';
                }
               
                $gatewayId = PaymentGateway::where('gateway', $name)->value('id');
    
                PaymentGatewayDetail::updateOrCreate([
                    'payment_gateway_id'=>$gatewayId,
                    'key'=>$detail,
                    'value'=>env($detail)
                ]);
            }
        } catch (\Throwable $th) {
            Log::info('payment gateways seeder : ' . $th->getMessage());
        }
    }
}
