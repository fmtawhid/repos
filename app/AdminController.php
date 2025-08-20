<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
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
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UserService $userService, Request $request) {
        $users = $userService->all($request);

        if($request->route()->getPrefix() === 'api') {
            return response()->json($users);
        }

        if($request->ajax()){

            return view('backend.admin.users.user-list', compact('users'))->render();
        }

        return view('backend.admin.users.index', compact('users'));
    }

    # save new admin staff
    public function store(UserRequest $request) {
        $data   = $request->getUserData();
        $result = User::query()->create($data);

        return $this->sendResponse(appStatic()::SUCCESS, 'Successfully added the user.', $result);
    }

    # update admin staff
    public function update(UserRequest $request, UserService $userService,int $id) {
        $admin = $userService->getUserById($id);
        if($admin) {
            $data   = $request->getUserData();
            $result = User::query()->where('id', $id)->update($data);

            return $this->sendResponse(appStatic()::SUCCESS, 'Successfully updated the user.', $result);
        }

        return $this->sendResponse(appStatic()::VALIDATION_ERROR, 'There is an error during updating the user.', []);
    }

    # update admin staff
    public function status(UserService $userService, Request $request, int $id) {
        $admin = $userService->getUserById($id);
        if($admin) {
            $data = [];
            if($request->has('is_active')) {
                $data['is_active'] = intval($request->is_active);
                $admin->update($data);
                $result = $admin;
                return $this->sendResponse(appStatic()::SUCCESS, 'Successfully changed the user status.', []);
            }
        }

        return $this->sendResponse(appStatic()::VALIDATION_ERROR, 'There is an error during updating the user.', []);
    }

    # delete admin staff
    public function destroy(UserService $userService, Request $request, $id) {
        $id = intval($id);
        $admin = $userService->getUserById($id);
        if($admin) {
            $admin->delete();
            return $this->sendResponse(appStatic()::SUCCESS, 'The user has been deleted successfully.', []);
        }

        return $this->sendResponse(appStatic()::VALIDATION_ERROR, 'There is an error during updating the user.', []);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUser(UserService $userService, $id) {
        $admin = $userService->getUserById($id);

        return $this->sendResponse(appStatic()::SUCCESS, '', $admin);
    }


}
