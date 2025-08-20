<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\SystemUpdateService;
use App\Models\License;
use App\Services\Action\FilePermissionActionService;
use App\Services\Action\LicenseActionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class FilePermissionController extends Controller
{
    public function filePermission()
    {
        try {
            $versionLists  = [];
            $response      = $this->versionList();
            if(!empty($response)){
                if(!empty($response->data)) {
                    $collections   = collect($response->data->version_lists);
                    $versionLists  = $collections->slice(appStatic()::maxUpdateFile);
                }
            }

            return view('backend.admin.update.file-list', compact('versionLists'));

        } catch (Exception $exception) {
            flash($exception->getMessage())->error();
            return redirect()->back();

        }
    }

    public function  versionList()
    {
        try {
            $license = (new LicenseActionService())->getMyLicense();

            if(empty($license)) {
                return ["status" => false, "data" => [], "error" => "Page not found"];
            }

            return (new FilePermissionActionService())->getVersionList();
        } catch (\Throwable $th) {
            Log::info("Failed ! version list response log issues :" . json_encode(errorArray($th)));

            return ["status" => false, "data" => [], "error" => $th->getMessage()];
        }
    }
}
