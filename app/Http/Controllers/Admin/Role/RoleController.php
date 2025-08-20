<?php

namespace App\Http\Controllers\Admin\Role;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\User\UserService;
use App\Services\Model\Role\RoleService;
use App\Http\Requests\Admin\Role\RoleStoreRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;

class RoleController extends Controller
{
    use ApiResponseTrait;
    private $appStatic;

    public function __construct()
    {
        $this->appStatic = appStatic();
    }

    public function index(Request $request, RoleService $roleService, UserService $userService)
    {
        $data["customGroupAndPermissions"] = $roleService->adminCustomRoutes();

        $data["roles"] = $roleService->getAll(true, null,["permissions"]);
        if($request->ajax()){
            return view("backend.admin.powerhouse.roles.role_lists")->with($data)->render();
        }

        return view("backend.admin.powerhouse.roles.index")->with($data);
    }

    public function store(RoleStoreRequest $request, RoleService $roleService)
    {
        try{
            DB::beginTransaction();
            $role = $roleService->store($request->validated());

            // Role Permission Save
            $roleService->rolePermissionStore($role, $request->routes);

            DB::commit();

            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                localize("Successfully stored Role"),
                $request->validated()
            );
        }
        catch(\Throwable $e){
            DB::rollBack();
            wLog("Failed to store Role", errorArray($e));
            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                localize("Failed to store Role."),
                [],
                errorArray($e)
            );
        }
    }

    public function edit(Request $request,$id, RoleService $roleService)
    {

        return $roleService->findById($id);
    }

    public function update(RoleUpdateRequest $request, $id, RoleService $roleService)
    {
        try{
            DB::beginTransaction();
            $role = $roleService->findById($id);

            $roleService->update($role, $request->validated());

            // Delete Old Permissions

            // Role Permission Save
            $role->permissions()->sync($request->routes);

            // Role User Permission update
            $roleService->roleUsersMenuPermissionIncrease($role);


            DB::commit();

            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                localize("Successfully Updated Role"),
                $role
            );
        }
        catch(\Throwable $e){
            DB::rollBack();
            wLog("Failed to update Role", errorArray($e));
            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                localize("Failed to update Role."),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, Role $role)
    {
        if ($request->ajax()) {
            try {
                // Ownership Check
                if($role->user_id != getUserParentId()){
                    return $this->sendResponse(
                        $this->appStatic::UNAUTHORIZED_ACTION,
                        localize("Sorry, You are not authorized to perform this action"),
                    );
                }

                // Modify the Role Users permission version
                (new UserService())->updateUserMenuPermissionVersionByRoleObject($role);

                //TODO:: Decision required to delete user_roles, role_permissions records.
                $role->delete();

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted role"),
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete Admin Staff", errorArray($e));
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete role : ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }

}
