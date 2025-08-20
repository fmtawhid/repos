<?php

namespace App\Http\Controllers\Admin\EmailTemplate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\EmailTemplate\EmailTemplateService;

class EmailTemplateController extends Controller
{
    use ApiResponseTrait;

    protected $appStatic;
    protected $emailTemplateService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->emailTemplateService = new EmailTemplateService();
    }
    public function index()
    {
        $data = $this->emailTemplateService->index();
        return view('backend.admin.emailTemplate.index', $data);
    }
    public function update(Request $request, $id)
    {
        try {
            $this->emailTemplateService->update($request, $id);

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Email template update successfully"),
            );
        } catch (\Throwable $e) {
            wLog("Failed to update email template", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to update email template"),
                [],
                errorArray($e)
            );
        }
    }
}
