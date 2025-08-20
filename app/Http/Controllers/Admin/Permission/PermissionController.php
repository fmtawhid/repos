<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Services\Models\Permission\PermissionService;

class PermissionController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request, PermissionService $permissionService)
    {
        $data["permissions"] = $permissionService->getAll(true);
        if ($request->ajax()){
            return view("backend.admin.powerhouse.permissions.permission_lists")->with($data)->render();
        }
        return view("backend.admin.powerhouse.permissions.index")->with($data);
    }

    public function update(Request $request,Permission $permission, PermissionService $permissionService)
    {
        if ($request->ajax()){
            try {
                $permission->update([
                    "is_allowed_in_demo" => !$permission->is_allowed_in_demo
                ]);

                $message = $permission->is_allowed_in_demo 
                ? localize("Successfully activated in demo mode.") : localize("Successfully deactivated Permission in demo mode.");

                return $this->sendResponse(
                    appStatic()::SUCCESS_WITH_DATA,
                    $message, $permission
                );
            }
            catch (\Exception $e) {
                wLog("Failed to update Permission", errorArray($e));
                return $this->sendResponse(
                    appStatic()::VALIDATION_ERROR,
                    localize("Failed to update Permission."),
                    [],
                    errorArray($e)
                );
            }
        }
    }


    public function storeRoutes(Request $request)
    {
        return (new PermissionService())->storeRoutes($request);
    }
}
