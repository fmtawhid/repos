<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Models\FAQ;
use Illuminate\Http\Request;
use App\Http\Resources\FAQResource;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\FAQ\FAQService;
use App\Http\Requests\Admin\FAQ\FAQRequestForm;

class FAQController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $faqService;
    public function __construct()
    {
        $this->faqService = new FAQService();
        $this->appStatic = appStatic();
    }
    public function index(Request $request)
    {
        $data["faqs"] = $this->faqService->getAll(true, null);
        if ($request->ajax()) {
            return view('backend.admin.faq.faq-lists', $data)->render();
        }
        return view("backend.admin.faq.index")->with($data);
    }
    public function store(FAQRequestForm $request)
    {
        try {
            $faq = $this->faqService->store($request->getData());
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                "Successfully stored faq",
                FAQResource::make($faq)
            );
        } catch (\Throwable $e) {
            wLog("Failed to Store faq", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store faq"),
                [],
                errorArray($e)
            );
        }
    }
    public function edit(FAQ $faq)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved faq"),
            $faq
        );
    }

    public function show(Request $request, $id)
    {
       return $id;
    }

    public function update(FAQRequestForm $request, FAQ $faq)
    {
        $data = $this->faqService->update($faq, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully faq Updated"),
            FAQResource::make($data)
        );
    }
    public function destroy(Request $request, FAQ $faq)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted faq"),
                    $faq->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete faq", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}
