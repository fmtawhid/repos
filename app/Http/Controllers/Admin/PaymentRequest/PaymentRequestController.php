<?php

namespace App\Http\Controllers\Admin\PaymentRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\PaymentRequest\PaymentRequestService;
use Illuminate\Support\Facades\DB;

class PaymentRequestController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $paymentRequestService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->paymentRequestService = new PaymentRequestService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function approve(Request $request)
    {
        try {
            DB::beginTransaction();

            $subscriptionUser = $this->paymentRequestService->approve($request->all());

            //TODO::Subscription Earning Added

            flashMessage(localize("Successfully! Payment status has been approved."));

            DB::commit();


            return redirect()->back();
//            return $this->sendResponse(
//                $this->appStatic::SUCCESS_WITH_DATA,
//                localize("Successfully approved"),
//            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to Store Tag", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store Tag"),
                [],
                errorArray($e)
            );
        }
    }
    public function feedback(Request $request)
    {
        try {
          
            $feedback = $this->paymentRequestService->feedback($request->all());

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored feedback"),
            
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store feedback", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store feedback"),
                [],
                errorArray($e)
            );
        }
    }
    public function reSubmit(Request $request)
    {
        try {
            $feedback = $this->paymentRequestService->reSubmit($request);

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored feedback"),
            
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store feedback", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store feedback"),
                [],
                errorArray($e)
            );
        }
    }
    public function reject(Request $request)
    {
        try {
            $reject = $this->paymentRequestService->reject($request->all());

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored Tag"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store reject", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to reject"),
                [],
                errorArray($e)
            );
        }
    }
    
}
