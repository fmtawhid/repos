<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Table\TableStoreRequest;
use App\Http\Requests\Admin\Table\TableUpdateRequest;
use App\Models\Table;
use App\Services\Area\AreaService;
use App\Services\QrCode\QrCodeService;
use App\Services\Table\TableService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{

    use ApiResponseTrait;
    protected $appStatic;
    protected $service;
    protected $areaService;
    protected $qrCodeService;

    public function __construct()
    {
        $this->appStatic     = new AppStatic();
        $this->service       = new TableService();
        $this->areaService   = new AreaService();
        $this->qrCodeService = new QrCodeService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data["tables"] = $this->service->getAll(true);

            return view('backend.admin.table.list', $data)->render();
        }

        $data["areas"] = $this->areaService->getAll(true);

        return view("backend.admin.table.index")->with($data);
    }


    public function store(TableStoreRequest $request) {
        try {
            DB::beginTransaction();
            $data = $request->getValidatedData();

            //01.Store Table's data
            $table = $this->service->store($data);

            //02.Create a qr code for this table
            $qrCode = $this->qrCodeService->createQrCode($table);

            //03. update table qr_code_id
            $table->update([
                "qr_code_id" => $qrCode->id]
            );

            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Table Created Successfully"),
                $table
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store Table", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to create Table"),
                [],
                errorArray($e)
            );
        }
    }

    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Table"),
            $this->service->findById($id)
        );
    }


    public function update(TableUpdateRequest $request, Table $table)
    {
        try {
            DB::beginTransaction();
            $data = $request->getValidatedData();
            $table->update($data);
            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Table Updated Successfully"),
                $table
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store Table", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Table"),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, Table $table)
    {
        if ($request->ajax()) {
            try {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Table successfully deleted"),
                    $table->qrCode()->delete(),
                    $table->delete()
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete Table", errorArray($e));
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete : ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }
}
