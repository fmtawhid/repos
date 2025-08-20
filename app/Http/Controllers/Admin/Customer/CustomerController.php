<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\CustomerResource;
use App\Services\Model\Customer\CustomerService;
use App\Http\Requests\Admin\Customer\CustomerRequestForm;

class CustomerController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $customerService;
    public function __construct()
    {
        $this->customerService = new CustomerService();
        $this->appStatic = appStatic();
    }
    public function index(Request $request)
    {
        $data = $this->customerService->index();
        if ($request->ajax()) {
            return view('backend.admin.customers.customer-list', $data)->render();
        }
        return view("backend.admin.customers.index")->with($data);
    }
    public function store(CustomerRequestForm $request)
    {
        try {
            DB::beginTransaction(); 
            $customer = $this->customerService->store($request);
            DB::commit() ;
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored customer"),
                CustomerResource::make($customer)
            );
        } catch (\Throwable $e) {
             DB::rollBack();
            wLog("Failed to Store customer", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store customer :") .$e->getMessage(),
                [],                
                errorArray($e)
            );
        }
    }
    public function edit(User $customer)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved customer"),
            $customer
        );
    }
    public function update(Request $request, $id)
    {
       $exitUser = $this->customerService->existUser($id, $request->email, $request->mobile_no);
        if($exitUser) {
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Customer already exists"),
            );
        }
        $data = $this->customerService->update($id, $request);
       
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully customer Updated"),
            CustomerResource::make($data)
        );
    }
    public function destroy(Request $request, User $customer)
    {
        if ($request->ajax()) {
            try {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted customer"),
                    $customer->delete()
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete customer", errorArray($e));
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete : ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }
    #export customer
    public function exports()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
