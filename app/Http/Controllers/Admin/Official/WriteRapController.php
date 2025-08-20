<?php

namespace App\Http\Controllers\Admin\Official;

use App\Http\Controllers\Controller;
use App\Services\Update\SystemUpdateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WriteRapController extends Controller
{
    public function healthCheck(Request $request)
    {

        $data = (new SystemUpdateService())->healthCheck();

        return view("backend.admin.system.health-check")->with($data);
    }

    public function update(Request $request)
    {
        try{

        }
        catch(\Throwable $e){

            wLog("", errorArray($e));
            
            return redirect()->back();
        }
    }
}
