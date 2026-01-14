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

    /**
     * Display list of users (with optional trashed users)
     */
    public function index(Request $request)
    {
        $data['branches'] = null;

        if (isAdmin() || isAdminTeam()) {
            $userType = appStatic()::TYPE_ADMIN_STAFF;
        } else {
            $data['branches'] = (new BranchService())->getBranchesByUserBranchId(user()->branch_id);
            $userType = appStatic()::TYPE_VENDOR_TEAM;
        }

        // Check if trashed users should be included
        $includeTrashed = $request->get('trashed', true);

        // Fetch users including trashed if requested
        $data['users'] = $this->userService->getAll(
            true,              // paginate
            null,              // all status
            $userType,         // user type
            true,              // bind parent
            ['roles'],         // load relationships
            $includeTrashed    // include trashed users
        );

        $data['roles'] = $this->roleService->getAll(false);

        if ($request->ajax()) {
            return view('backend.admin.users.user-list', $data)->render();
        }

        return view("backend.admin.users.index")->with($data);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();

            $user = $this->userService->store($data);

            if ($request->has('role_id')) {
                $this->userService->userRoleAssign($user, $request->role_id);
            }

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
        $user = $this->userService->findById($id);
        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit User"),
            $user
        );
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();
            $data["menu_permission_version"] = $user->menu_permission_version + 1;

            $user->update($data);

            $this->userService->deleteUserRoleByUser($user);

            if ($request->has("role_id") && !empty($request->role_id)) {
                $this->userService->userRoleAssign($user, $request->role_id);
            }

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("User Updated Successfully"),
                UserResource::make($user)
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to update User", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update User"),
                [],
                errorArray($e)
            );
        }
    }

    /**
     * Soft delete user
     */
    public function destroy(Request $request, User $user)
    {
        try {
            $user->delete(); // Soft delete
            return $this->sendResponse(
                $this->appStatic::SUCCESS,
                localize("User moved to trash successfully")
            );
        } catch (\Throwable $e) {
            wLog("Failed to Delete User", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete User") . " " . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

    /**
     * Restore soft deleted user
     */
    public function restore($id)
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);
            $user->restore();
            return $this->sendResponse(
                $this->appStatic::SUCCESS,
                localize("User restored successfully")
            );
        } catch (\Throwable $e) {
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to restore User") . " " . $e->getMessage()
            );
        }
    }

    /**
     * Permanently delete user
     */
    public function forceDelete($id)
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);

            DB::beginTransaction();
            $this->userService->deleteUserRoleByUser($user); // remove roles
            $user->forceDelete();
            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS,
                localize("User permanently deleted")
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to permanently delete User") . " " . $e->getMessage()
            );
        }
    }
}
