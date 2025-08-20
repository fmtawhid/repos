<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;

class BalanceController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $packageService;
    public function __construct()
    {
        $this->appStatic = appStatic();
    }
    public function index(Request $request)
    {
        $type = $request->type;
        $view = view('backend.admin.balance.index', compact('type'))->render();

        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved balance"),
            $view
        );
    }
}
