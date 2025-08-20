<?php

namespace App\Http\Controllers\Admin\Subscriber;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\Subscriber\SubscribersService;

class SubscribersController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $subscribersService;
    public function  __construct()
    {
        $this->appStatic = appStatic();
        $this->subscribersService = new SubscribersService();
    }
    public function index(Request $request)
    {
        $search = $request->search;
        $data =  [];
        if($request->ajax()) {
            $data = $this->subscribersService->index($search); 
            return view('backend.admin.subscribers.lists', $data);
        }
        return view('backend.admin.subscribers.index', $data);
    }
    public function destroy(Request $request, $id)
    {
        try {
           
            $this->subscribersService->delete($id);        
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
              localize("Successfully deleted") ,              
            );
        } catch (\Throwable $e) {

            wLog("Failed to delete", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to delete"),
                [],
                errorArray($e)
            );
        }
    }
}

