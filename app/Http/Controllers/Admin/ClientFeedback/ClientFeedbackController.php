<?php

namespace App\Http\Controllers\Admin\ClientFeedback;

use Illuminate\Http\Request;
use App\Models\ClientFeedback;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\ClientFeedback\ClientFeedbackService;
use App\Http\Requests\Admin\ClientFeedback\ClientFeedbackRequestForm;

class ClientFeedbackController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $clientFeedbackService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->clientFeedbackService = new ClientFeedbackService();
    }

    public function index(Request $request)
    {
        $data["client_feedbacks"] = $this->clientFeedbackService->getAll(true, null);

        if ($request->ajax()) {
            return view('backend.admin.appearance.client-feedback.client-feedback-lists', $data)->render();
        }

        return view("backend.admin.appearance.client-feedback.index")->with($data);
    }

    public function store(ClientFeedbackRequestForm $request)
    {
        try {
             $this->clientFeedbackService->store($request->getData());

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored Client Feedback"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store Client Feedback", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store Client Feedback"),
                errorArray($e)
            );
        }
    }

    public function edit(ClientFeedback $clientFeedback)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved Client Feedback"),
            $clientFeedback
        );
    }

    public function show($id)
    {
        return $id;
    }

    public function update(ClientFeedbackRequestForm $request, ClientFeedback $clientFeedback)
    {
        $data = $this->clientFeedbackService->update($clientFeedback, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully Client Feedback Updated"),
        );
    }

    public function destroy(Request $request, ClientFeedback $clientFeedback)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted the Client Feedback"),
                    $clientFeedback->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete the Client Feedback", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : " ). $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}