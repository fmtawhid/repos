<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Model\FAQ\FAQService;
use Illuminate\Http\Request;
use App\Models\ContactUsMessage;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Requests\Frontend\ContactUsRequestForm;

class ContactUsController extends Controller
{
    use ApiResponseTrait;

    protected $appStatic;
    public function __construct()
    {
        $this->appStatic = appStatic();
    }
    public function index()
    {
        $data['faqs'] = (new FAQService())->getAll(true, true);

        return view('frontend.default.pages.quickLinks.contact-us')->with($data);
    }

    public function store(ContactUsRequestForm $request)
    {
        try {

            $score = recaptchaValidation($request);

            $request->request->add([
                'score' => $score
            ]);
            $data['score'] = 'required|numeric|min:0.9';

            $request->validate($data, [
                'score.min' => localize('Google recaptcha validation error, seems like you are not a human.')
            ]);
            $msg = new ContactUsMessage;
            $msg->name          = $request->name;
            $msg->email         = $request->email;
            $msg->phone         = $request->phone;
            $msg->message       = $request->message;
            $msg->save();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully Send Your Message"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store Tag", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store"),
                [],
                errorArray($e)
            );
        }
    }
}
