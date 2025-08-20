<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Model\Role\RoleService;
use App\Services\Model\User\UserService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use ApiResponseTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UserService $userService, Request $request, RoleService $roleService)
    {
        $data["users"] = $userService->getAll(
            true,
            null,
            null,
            true,
            ["roles"]
        );
        $data["roles"] = $roleService->getAll(false);

        if ($request->route()->getPrefix() === 'api') {
            return response()->json($data);
        }

        if ($request->ajax()) {

            return view('backend.admin.users.user-list', $data)->render();
        }

        return view('backend.admin.users.index')->with($data);
    }

    # save new admin staff
    public function store(UserRequest $request)
    {
        $data = $request->getUserData();
        $result = User::query()->create($data);

        return $this->sendResponse(appStatic()::SUCCESS, localize('Successfully added the user.'), $result);
    }

    # update admin staff
    public function update(UserRequest $request, UserService $userService, int $id)
    {
        $admin = $userService->getUserById($id);
        if ($admin) {
            $data = $request->getUserData();
            $result = User::query()->where('id', $id)->update($data);

            return $this->sendResponse(appStatic()::SUCCESS, localize('Successfully updated the user.'), $result);
        }

        return $this->sendResponse(appStatic()::VALIDATION_ERROR, localize('There is an error during updating the user.'), []);
    }

    # update admin staff
    public function status(UserService $userService, Request $request, int $id)
    {
        $admin = $userService->getUserById($id);
        if ($admin) {
            $data = [];
            if ($request->has('is_active')) {
                $data['is_active'] = intval($request->is_active);
                $admin->update($data);
                $result = $admin;
                return $this->sendResponse(appStatic()::SUCCESS, localize('Successfully changed the user status.'), []);
            }
        }

        return $this->sendResponse(appStatic()::VALIDATION_ERROR, localize('There is an error during updating the user.'), []);
    }

    # delete admin staff
    public function destroy(UserService $userService, Request $request, $id)
    {
        $id = intval($id);
        $admin = $userService->getUserById($id);
        if ($admin) {
            $admin->delete();
            return $this->sendResponse(appStatic()::SUCCESS, localize('The user has been deleted successfully.'), []);
        }

        return $this->sendResponse(appStatic()::VALIDATION_ERROR, localize('There is an error during updating the user.'), []);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUser(UserService $userService, $id)
    {
        $admin = $userService->getUserById($id);

        return $this->sendResponse(appStatic()::SUCCESS, '', $admin);
    }

    public function envatoProducts(Request $request)
    {
            return response()->json([
                "status" => true,
                "message" => "Hello ",
                "data" => [
                    [
                        "id" => fake()->numberBetween(1,50),
                        "title" => fake()->name
                    ],
                    [
                        "id" => fake()->numberBetween(1,50),
                        "title" => fake()->name
                    ],
                ]
            ],201);
    }

}
