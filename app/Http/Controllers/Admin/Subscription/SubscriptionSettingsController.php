<?php

namespace App\Http\Controllers\Admin\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Models\PaymentGatewayProduct;
use App\Http\Requests\GatewayProductStoreRequestForm;
use App\Http\Controllers\Payments\Paypal\PaypalController;
use App\Services\Model\SubscriptionPlan\SubscriptionSettingsService;

class SubscriptionSettingsController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $subscriptionSettingsService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->subscriptionSettingsService = new SubscriptionSettingsService();
    }
    public function index()
    {
        $data = $this->subscriptionSettingsService->index();
        return view('backend.admin.subscriptions.settings.index', $data);
    }
    public function store(GatewayProductStoreRequestForm $request)
    {
        
    }
    public function storeGatewayProduct(Request $request)
    {
       
        try{
            if($request->gateway == 'paypal') {

                if($request->packages) {
                    foreach($request->packages as $package_id) {
                        $exitProduct = PaymentGatewayProduct::where('subscription_plan_id', $package_id)->where('is_active', 1)->where('gateway', 'paypal')->first();
                      
                        if(!$exitProduct) {
                            PaypalController::createProduct($package_id);
                        }                    
                    }
                }
            }
          
            return redirect()->route('admin.subscription-settings.index');
        }catch(\Exception $e){
          return redirect()->back();
        }
    }
}
