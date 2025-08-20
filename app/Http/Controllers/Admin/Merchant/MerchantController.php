<?php

namespace App\Http\Controllers\Admin\Merchant;

use App\Exports\MerchantExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Merchant\MerchantRequestForm;
use App\Http\Resources\MerchantResource;
use App\Traits\Api\ApiResponseTrait;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Model\Merchant\MerchantService;

// used ad vendors
class MerchantController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $merchantService;

    public function __construct()
    {
        $this->merchantService = new MerchantService();
        $this->appStatic = appStatic();
    }
    public function index(Request $request)
    {    
        $data = $this->merchantService->index();

        if ($request->ajax()) {
            return view('backend.admin.merchants.list', $data)->render();
        }
        return view("backend.admin.merchants.index")->with($data);
    }
    
    public function store(MerchantRequestForm $request)
    {
        try {
            DB::beginTransaction(); 
            $merchant = $this->merchantService->store($request);
            DB::commit() ;
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored merchant"),
                MerchantResource::make($merchant)
            );
        } catch (\Throwable $e) {
             DB::rollBack();
            wLog("Failed to Store merchant", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store merchant :") .$e->getMessage(),
                [],                
                errorArray($e)
            );
        }
    }
    public function edit(User $merchant)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved merchant"),
            $merchant
        );
    }
    public function update(Request $request, $id)
    {
       $exitUser = $this->merchantService->existUser($id, $request->email, $request->mobile_no);
        if($exitUser) {
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("merchant already exists"),
            );
        }
        $data = $this->merchantService->update($id, $request);
       
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully merchant Updated"),
            merchantResource::make($data)
        );
    }
    public function destroy(Request $request, User $merchant)
    {
        if ($request->ajax()) {
            try {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted merchant"),
                    $merchant->delete()
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete merchant", errorArray($e));
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete : ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }
    #export merchant
    public function exports()
    {
        return Excel::download(new MerchantExport, 'merchants.xlsx');
    }
}
