<?php

namespace Modules\PosManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\PosManager\App\Http\Requests\PosOrderRequest;
use Modules\PosManager\Services\Action\PosOrderActionService;

class PosOrderController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posmanager::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posmanager::create');
    }


    public function placeOrder(PosOrderRequest $request, PosOrderActionService $posOrderActionService)
    {
        // dd($request->validated());
        try{
            DB::beginTransaction();

            $order = $posOrderActionService->placeOrder($request->validated());
            $order->print_route = route('print.invoice', $order->id);
            DB::commit();

            if($request->ajax()){

                return $this->sendResponse(
                    requestResponse()::SUCCESS_WITH_DATA,
                    localize("Successfully placed order"),
                    $order
                );
            }

            flashMessage("success","Successfully placed a order");

            return back();
        }
        catch (\Throwable $e){
            DB::rollBack();

            wLog("Failed to place POS Order",errorArray($e),logService()::LOG_ORDER);

            if($request->ajax()) {

                return $this->sendResponse(
                    requestResponse()::BAD_REQUEST,
                    localize("Error placing order") . ": " . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }


//

            return back()->withInput($request->except("_token"));
        }
    }

    public function receiveBill(Request $request, PosOrderActionService $posOrderActionService) {
                
        try {
            $order = $posOrderActionService->receiveBill();
            if(!$order){
                return $this->sendResponse(
                    requestResponse()::BAD_REQUEST,
                    localize("Order not found"),
                    []
                );
            }
            return $this->sendResponse(
                requestResponse()::SUCCESS_WITH_DATA,
                localize("Successfully added bill"),
                $order
            );
        } catch (\Throwable $e) {
            return $this->sendResponse(
                requestResponse()::BAD_REQUEST,
                localize("Error placing bill") . ": " . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('posmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('posmanager::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
