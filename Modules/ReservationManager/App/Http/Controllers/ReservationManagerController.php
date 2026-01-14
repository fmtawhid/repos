<?php

namespace Modules\ReservationManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Area\AreaService;
use App\Services\Table\TableService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\BranchModule\App\Services\BranchService;
use Modules\ReservationManager\App\Http\Requests\ReservationStoreRequest;
use Modules\ReservationManager\App\Http\Requests\ReservationUpdateRequest;
use Modules\ReservationManager\App\Models\Reservation;
use Modules\ReservationManager\App\Services\Reservation\ReservationService;

class ReservationManagerController extends Controller
{

    use ApiResponseTrait;
    protected $appStatic;
    protected $service;
    protected $branchService;
    protected $tableService;

    public function __construct()
    {
        $this->appStatic     = new AppStatic();
        $this->service       = new ReservationService();
        $this->branchService = new BranchService();
        $this->tableService  = new TableService();
    }

    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $data["reservations"]   = $this->service
    //         ->getAll(true, true, ['status', 'branch', 'customer', 'reservationTable', 'vendor']);

    //     $data["branches"]       = $this->branchService->getAll(null, true);

    //     // dd($data);
    //     if ($request->ajax()) {
    //         return view('reservationmanager::list', $data)->render();
    //     }

    //     return view('reservationmanager::index')->with($data);
    // }
    public function index(Request $request)
    {
        $data['branches'] = $this->branchService->getAll(null, true);

        if ($request->ajax()) {
            $data['reservations'] = Reservation::with(['branch', 'customer', 'reservationTable', 'status'])
                ->withTrashed()
                ->latest()
                ->paginate(10);

            return view('reservationmanager::list', $data)->render();
        }

        return view('reservationmanager::index')->with($data);
    }

    public function create()
    {
        $data["branches"]       = $this->branchService->getAll(null, true);

        return view('reservationmanager::create')->with($data);                
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request) 
    {   
        try {           
            DB::beginTransaction();
            $data = $request->getValidatedData();

            $this->service
                ->createReservationCustomer($request->only('customer_first_name', 'customer_last_name', 'customer_phone', 'customer_email'))
                ->storeReservation($data)
                ->storeReservationTable($data);              
            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Reservation Created Successfully"),
                $data
            );

        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to Store Reservation", errorArray($e));            
            flashMessage($e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('reservationmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data["tables"]         = $this->tableService->getAll(false, true);
        $data["branches"]       = $this->branchService->getAll(null, true);
        $data['reservation']    = $this->service->findbyid($id, ['branch', 'area', 'customer', 'reservationTable', 'vendor', 'status', 'reservationTable.table']);
        
        return view('reservationmanager::edit')->with($data);               
    }

    /**
     * Update the specified resource in storage.
     */    
    public function update(ReservationUpdateRequest $request, Reservation $reservationmanager)
    {        
        try {
            DB::beginTransaction();
            $data = $request->getValidatedData();

            $this->service
                ->setModel($reservationmanager)
                ->updateReservationCustomer($request->only('customer_first_name', 'customer_last_name', 'customer_phone', 'customer_email'))
                ->updateReservation($data)
                ->updateReservationTable($data);

            DB::commit();
            return redirect()->route('reservationmanager.index')
                ->with('success', localize("Reservation Updated Successfully"));

        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to Store Reservation", errorArray($e));            
            flashMessage($e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
 // Soft delete
    public function destroy(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($request->ajax()) {
            try {
                $reservation->delete(); // soft delete
                return $this->sendResponse($this->appStatic::SUCCESS, "Reservation Soft Deleted Successfully");
            } catch (\Throwable $e) {
                return $this->sendResponse($this->appStatic::VALIDATION_ERROR, "Failed to delete reservation", [], errorArray($e));
            }
        }
    }

    // Restore
    public function restore($id)
    {
        $reservation = Reservation::onlyTrashed()->findOrFail($id);
        $reservation->restore();

        return $this->sendResponse($this->appStatic::SUCCESS, "Reservation Restored Successfully", $reservation);
    }

    // Force Delete
    public function forceDelete($id)
    {
        $reservation = Reservation::onlyTrashed()->findOrFail($id);

        // Delete related reservation tables first
        $reservation->reservationTable()->delete(); // soft-delete first
        // or ->forceDelete() if you want hard delete too
        $reservation->forceDelete();

        return $this->sendResponse($this->appStatic::SUCCESS, "Reservation Permanently Deleted");
    }
                
        



    public function getTableListByBranchId(Request $request, $branch_id)
    {
        $tableService =  new TableService();
        $data = $tableService->getTablesByBranchIdUsingAreaBranch($branch_id, ['area:id,name,number_of_tables,is_active']);

        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Table List"),
            $data            
        );
    }


    public function getAreaListByBranchId(Request $request, $branch_id)
    {
        $area_list =  (new AreaService())->getAreaByBranchId($branch_id);

        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Area List"),
            $area_list            
        );
    }


    
    public function getTableListByAreaId(Request $request, $area_id)
    {
        $data = (new TableService())->findTableByAreaId($area_id, ['qrCode']);
        

        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Table List"),
            $data            
        );
    }
}
