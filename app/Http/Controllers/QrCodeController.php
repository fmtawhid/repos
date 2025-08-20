<?php

namespace App\Http\Controllers;

use App\Services\Area\AreaService;
use App\Services\QrCode\QrCodeService;
use App\Services\Table\TableService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $service;
    protected $areaService;
    protected $tableService;

    public function __construct()
    {
        $this->appStatic    = new AppStatic();
        $this->service      = new QrCodeService();
        $this->areaService  = new AreaService();
        $this->tableService = new TableService();
    }

    public function index(Request $request)
    {
        $data["areas"] = $this->areaService->getAll(false, true);

        if ($request->ajax()) {
            $data["tables"] = $this->tableService->findTableByAreaId($request->area_id, []);
            return view('backend.admin.qrcodes.list', $data)->render();
        }        

        return view("backend.admin.qrcodes.index")->with($data);
    }
}