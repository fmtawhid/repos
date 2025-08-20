<?php

namespace App\Http\Controllers\Admin\Support;

use Illuminate\Http\Request;
use App\Models\SupportPriority;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\Support\PriorityService;
use App\Http\Resources\Admin\Support\PriorityResource;
use App\Http\Requests\Admin\Support\PriorityRequestForm;

class PriorityController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $priorityService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->priorityService = new PriorityService();
    }
    public function index(Request $request)
    {
        $data["priorities"] = $this->priorityService->getAll(true, null);
       
        if ($request->ajax()) {
            return view('backend.admin.support.priorities.priority-list', $data)->render();
        }
        return view("backend.admin.support.priorities.index")->with($data);
    }
    public function store(PriorityRequestForm $request)
    {
        try {
            $priority = $this->priorityService->store($request->getData());
            return $this->sendResponse( 
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored priority"),
                PriorityResource::make($priority)
            );
        } catch (\Throwable $e) {
            wLog("Failed to Store priority", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store priority"),
                [],
                errorArray($e)
            );
        }
    }
    public function edit(SupportPriority $supportPriority)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved priority"),
            $supportPriority
        );
    }

    public function update(PriorityRequestForm $request, SupportPriority $supportPriority)
    {
        $data = $this->priorityService->update($supportPriority, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully priority Updated"),
            PriorityResource::make($data)
        );
    }
    public function destroy(Request $request, SupportPriority $supportPriority)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted priority"),
                    $supportPriority->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete priority", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}