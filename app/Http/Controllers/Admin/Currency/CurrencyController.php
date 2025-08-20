<?php

namespace App\Http\Controllers\Admin\Currency;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Resources\CurrencyResource;
use App\Services\Model\Currency\CurrencyService;
use App\Http\Requests\Currency\CurrencyRequestForm;

class CurrencyController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $currencyService;
    public function  __construct()
    {
        $this->appStatic = appStatic();
        $this->currencyService = new CurrencyService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data["currencies"] = $this->currencyService->getAll(true, null);
        if ($request->ajax()) {
            return view('backend.admin.currencies.currency-list', $data)->render();
        }

        return view("backend.admin.currencies.index")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyRequestForm $request)
    {
        try {
           
            $currency = $this->currencyService->store($request->getData());
        
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored currency"),
                CurrencyResource::make($currency)
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store currency", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store currency"),
                [],
                errorArray($e)
            );
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved currency"),
            $currency
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyRequestForm $request, Currency $currency)
    {
        $data = $this->currencyService->update($currency, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully currency Updated"),
            CurrencyResource::make($data)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Currency $currency)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted currency"),
                    $currency->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete Folder", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
    public function changeCurrency(Request $request)
    {

        $request->session()->put('currency_code', $request->currency_code);
        $currency = Currency::where('code', $request->currency_code)->first();
        $request->session()->put('local_currency_rate', $currency->rate);
        $request->session()->put('currency_symbol', $currency->symbol);
        $request->session()->put('currency_symbol_alignment', $currency->alignment);

        $msg = localize('Currency changed to ') . ' ' . $currency->name;
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            $msg);
         
    }
}
