<?php

namespace App\Http\Controllers\Admin\PaymentGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Model\PaymentGateway\PaymentGatewayService;
use App\Traits\Api\ApiResponseTrait;

class PaymentGatewayController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $paymentGatewayService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(
    ) {
        $this->appStatic = appStatic();
        $this->paymentGatewayService = new PaymentGatewayService();
    }
    public function index(Request $request)
    {
        $data =$this->paymentGatewayService->index();
        if ($request->ajax()) {
            return view('backend.admin.payment-method.list', $data)->render();
        }

        return view('backend.admin.payment-method.index', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tag = $this->paymentGatewayService->updateGatewayDetails($request);
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored payment method credential"),
            );
        } catch (\Throwable $e) {
            wLog("Failed to Store payment method credential", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store payment method credential"),
                [],
                errorArray($e)
            );
        }
    }
}
