<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Models\OfflinePaymentMethod;
use App\Http\Resources\OfflinePaymentMethodResource;
use App\Services\Model\OfflinePaymentMethod\OfflinePaymentMethodService;
use App\Http\Requests\Admin\OfflinePaymentMethod\OfflinePaymentMethodRequestForm;

class OfflinePaymentMethodController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $offlinePaymentMethodService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->offlinePaymentMethodService = new OfflinePaymentMethodService();
    }

    public function index(Request $request)
    {
        $data["offline_payment_methods"] = $this->offlinePaymentMethodService->getAll(true, null);

        if ($request->ajax()) {
            return view('backend.admin.offlinePaymentMethods.method-lists', $data)->render();
        }

        return view("backend.admin.offlinePaymentMethods.index")->with($data);
    }

    public function store(OfflinePaymentMethodRequestForm $request)
    {
        try {
            $offlinePaymentMethod = $this->offlinePaymentMethodService->store($request->getData());

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored Offline Payment Method"),
                OfflinePaymentMethodResource::make($offlinePaymentMethod)
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store Offline Payment Method", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store Offline Payment Method"),
                errorArray($e)
            );
        }
    }

    public function edit(OfflinePaymentMethod $offlinePaymentMethod)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            "Successfully retrieved Offline Payment Method",
            $offlinePaymentMethod
        );
    }

    public function show($id)
    {
    }

    public function update(OfflinePaymentMethodRequestForm $request, OfflinePaymentMethod $offlinePaymentMethod)
    {
        $data = $this->offlinePaymentMethodService->update($offlinePaymentMethod, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            "Successfully Offline Payment Method Updated",
            OfflinePaymentMethodResource::make($data)
        );
    }

    public function destroy(Request $request, OfflinePaymentMethod $offlinePaymentMethod)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    "Successfully deleted the Offline Payment Method",
                    $offlinePaymentMethod->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete the Offline Payment Method", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                "Failed to Delete : " . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}
