<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\SubscribedUser;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Requests\Frontend\SubscribeEmailRequestForm;

class SubscribersController extends Controller
{
    use ApiResponseTrait;

    protected $appStatic;
    public function __construct()
    {
        $this->appStatic = appStatic();
    }

    public function store(SubscribeEmailRequestForm $request)
    {
        try {

            SubscribedUser::updateOrCreate([
                'email'=>$request->email
            ]);
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully Subscribed"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Subscribed", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                $e->getMessage()
                [],
                errorArray($e)
            );
        }
    }
}