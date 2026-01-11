<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Resources\Admin\User\UserResource;
use App\Models\User;
use App\Services\Model\Role\RoleService;
use App\Services\Model\User\UserService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\BranchModule\App\Services\BranchService;

class UserController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $userService;
    protected $roleService;
    public function __construct()
    {
        $this->appStatic   = new AppStatic();
        $this->userService = new UserService();
        $this->roleService = new RoleService();
    }
    public function index(Request $request)
    {
    
        $data['branches'] = null;
        if(isAdmin() || isAdminTeam()){
            $userType = appStatic()::TYPE_ADMIN_STAFF;
        }else{
            $data['branches'] = (new BranchService())->getBranchesByUserBranchId(user()->branch_id);
            $userType = appStatic()::TYPE_VENDOR_TEAM;
        }

        $data["users"] = $this->userService->getAll(true, null, $userType, true, ["roles"]);

        $data["roles"] = $this->roleService->getAll(false);
        if ($request->ajax()) {
            return view('backend.admin.users.user-list', $data)->render();
        }
        return view("backend.admin.users.index")->with($data);
    }

    public function store(UserStoreRequest $request) {

        try {
           
            DB::beginTransaction();
            $data = $request->getValidatedData();
            // User Data Storing
            $user = $this->userService->store($data);
            // User Role Assign
            $roles = $this->userService->userRoleAssign($user, $request->role_id);

            // Bump user's menu permission version so their menu is rebuilt on next request
            $user->update(["menu_permission_version" => $user->menu_permission_version + 1]);

            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("User Created Successfully"),
                UserResource::make($user)
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store User", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to create User"),
                [],
                errorArray($e)
            );
        }
    }

    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit User"),
            $this->userService->findById($id)
        );
    }

    public function update(UserUpdateRequest $request, User $user)
    {
     
        try {
            // Throw exception when a merchant or merchant agent/employees trying to create Merchant Account.
            // if (isCustomerUserGroup()) {
            //     throw_if($request->accountFor == $this->appStatic::TYPE_CUSTOMER, \Throwable::class, "Sorry Mate, You are not allowed to Register Customer");
            // }
            DB::beginTransaction();
            $data = $request->getValidatedData();
            $data["menu_permission_version"] = $user->menu_permission_version + 1;
            // User Data Storing
            $user->update($data);
            // Delete Old Role
            $this->userService->deleteUserRoleByUser($user);
            // User Role Assign
            if ($request->has("role_id") && !empty($request->role_id)) {
                $roles = $this->userService->userRoleAssign($user, $request->role_id);
            }
            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("User Created Successfully"),
                UserResource::make($user)
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store User", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update User"),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, User $user)
    {
        if ($request->ajax()) {
            try {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted Admin Staff"),
                    $user->delete()
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete Admin Staff", errorArray($e));
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
