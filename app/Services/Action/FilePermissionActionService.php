<?php

namespace App\Services\Action;

use App\Http\Services\SystemUpdateService;
use Illuminate\Support\Facades\URL;

/**
 * Class FilePermissionActionService.
 */
class FilePermissionActionService
{

    public function getVersionList(object | null $license)
    {
         $opts = [
            'purchase_code'        => $license ? $license->purchase_code: '',
            'app_name'             => env('APP_NAME'),
            'current_version'      => currentVersion(),
            'customer_current_url' => url("/"),
            'client_token'         => $license ? $license->client_token : '',
            'product_type'         => 1,
            'server_info'          => $_SERVER,
            'app_env'              => $license?->app_env
        ];

        $systemUpdate = new SystemUpdateService;
        $response     = $systemUpdate->versionLists($opts);
        $response     = json_decode($response);


        return json_last_error() === JSON_ERROR_NONE ? $response : ["status" => false, "data" => [], "error" => "Page not found"];
    }
}
