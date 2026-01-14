<?php

namespace App\Services\Model\User;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use DB;

class UserService
{
    public function all()
    {
        $request  = request();
        $search   = $request->search;
        $userType = $request->user_type ? intval($request->user_type) : 0;

        $query = User::query();

        if(!empty($search)) {
            $query = $query->search($search);
        }
        if(!empty($userType)) {
            $query = $query->userType($userType);
        }
        if($request->has('is_active')) {
            $query = $query->isActive(intval($request->is_active));
        }
        return $query->latest()->paginate(request('perPage', appStatic()::PER_PAGE_DEFAULT), "*", "page", request('page', 0))->withQueryString();
    }

    /**
     * @incomingParams $paginatePluckOrGet will contain null,true, false.
     *  $paginatePluckOrGet == null means return pluck data.
     *  $paginatePluckOrGet == true means return paginate data.
     *  $paginatePluckOrGet == false means return get data.
     *
     * @incomingParams $onlyActive will contain null,true, false.
     * $onlyActive == null means return categories all rows.
     * $onlyActive == true means return only active categories where is_active column value is 1.
     * $onlyActive == false means return only active categories where is_active column value is 0.
     * */
    public function getAll($paginatePluckOrGet = null, $onlyActive = null, $userType = null, $bindParentUser = true, $withRelationship = [], $includeTrashed = false)
{
    $query = User::query()->name(request()->search)
        ->latest("id")
        ->when(isAdmin() == false, function($q){
            $q->where('created_by_id', userID());
        });

    if ($includeTrashed) {
        $query = $query->withTrashed();
    }

    (empty($withRelationship) ? $query : $query->with($withRelationship));

    ($bindParentUser && isAdmin() == false ? $query->where("parent_user_id", getAdminOrCustomerId()) : false);

    if(!is_null($onlyActive)){
        $query->isActive($onlyActive);
    }

    if(!is_null($userType)){
        $query->where('user_type', $userType);
    }

    return $paginatePluckOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
}

    // public function getAll(
    //     $paginatePluckOrGet = null,
    //     $onlyActive         = null,
    //     $userType           = null,
    //     $bindParentUser     = true,
    //     $withRelationship = []
    // ) {
    //     $request    = request();
    //     $onlyActive = $request->is_active ?? $onlyActive;
    //     $userType   = $request->user_type ?? $userType;

    //     $query = User::query()->name($request->search)
    //         ->latest("id")->when(isAdmin() == false, function($q){
    //             $q->where('created_by_id', userID());
    //         });
    //     (empty($withRelationship) ? $query : $query->with($withRelationship));

    //      ($bindParentUser &&  isAdmin() == false ? $query->where("parent_user_id", getAdminOrCustomerId()) : false);

    //     if(!is_null($onlyActive)){
    //         $query->isActive($onlyActive);
    //     }

    //     if(!is_null($userType)){
    //         $query->where('user_type', $userType);
    //     }

    //     // Pluck Data Returning
    //     if (is_null($paginatePluckOrGet)) {
    //         return $query->pluck("id", "first_name");
    //     }


    //     return $paginatePluckOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    // }

    /**
     * User Store
     * */
    public function store($payloads) : Model
    {
        return User::query()->create($payloads);
    }

    /**
     * User Role Assign
     * */
    public function userRoleAssign($user, $roles) : Model
    {
        return $this->saveUserRole($user->id, $roles);

    }

    public function deleteUserRoleByUser(object $user)
    {
        return UserRole::query()->where("user_id", $user->id)->delete();
    }


    public function saveUserRole(int $user_id, int $role_id) : Model
    {
        return UserRole::query()->create([
            "role_id" => $role_id,
            "user_id" => $user_id
        ]);
    }


    public function getUserById($id, $isFirstOnly = true)
    {
        $query =  User::query();
        return $isFirstOnly ? $query->find($id) : $query->findOrFail($id);
    }



    /**
     * Balance Update
     * */
    public function balanceUpdate(array $usages)
    {
        $getPromptCompletionTokens = getPromptCompletionToken($usages);
        $promptToken      = $getPromptCompletionTokens[0] ?? 0;
        $completionTokens = $getPromptCompletionTokens[1] ?? 0;
        $totalTokens      = $getPromptCompletionTokens[2] ?? 0;
        info("Prompt Token = ".$promptToken);
        info("Completion Token = ".$completionTokens);
        info("Total Token = ".$totalTokens);

        //TODO:: Update User Balance....
    }


    /**
     * Case 1:
     *      When logged-in user is a super admin type = 1. it will add two types of user. One is merchant type == 3, another is Super Admin official Employee/Agent type == 2.
     *      ##################################################################################################################################
     *      #   When it will be type == 2 or 3 ?                                                                                             #
     *      #   We will receive a value from the blade file & it will carry a value 1 either 2 with name of accountFor                       #
     *      #   If accountFor name contain value is 1 means Super Admin or Super Admin Employee registering a Merchant Account.              #
     *      #   Otherwise, a new Super-Admin official Employees.                                                                             #
     *      ##################################################################################################################################
     * Case 2:
     *      When logged-in user is a Merchant type == 3. it will add only one types of user is employee. And Type will be 4
     * Case 3:
     *      When logged-in user is a Merchant Employee Type == 3. it will add only one types of users is employee and type will be == 4
     * */
    public function userType($value)
    {
        $user = user();
        $user_type = $user->user_type;
        $appStatic = appStatic();

        // If Logged-in user is a Customer
        if ($user_type == $appStatic::TYPE_CUSTOMER || $user_type == $appStatic::TYPE_VENDOR_TEAM) {

            return $appStatic::TYPE_VENDOR_TEAM;
        }

        // If Logged in user is Super Admin type == 1
        if ($user_type == $appStatic::TYPE_ADMIN || $user_type == $appStatic::TYPE_ADMIN_STAFF) {

            return $value == 1 ? $appStatic::TYPE_CUSTOMER : $appStatic::TYPE_ADMIN_STAFF;
        }
    }

    public function findById($id, $conditions = [])
    {
        return User::query()->with("role")->when(!empty($conditions), function($q) use($conditions){
            $q->where($conditions);
        })->findOrFail($id);
    }
    public function profile($id = null)
    {
        $id = $id ?? user()->id;
        return $this->findById($id);
    }

    public function getUsersByUserId($userId = null, $paginatePluckOrGet = null)
    {
        if(!isAdmin()){
            $userId = getUserParentId();
        }

        $query = User::query()
            ->when(isAdmin(), function ($q) use ($userId) {
                $q->when(!empty($userId), function ($q) use ($userId) {
                    $q->where("id", $userId);
                });
            })
            ->when(!isAdmin(), function ($q) use ($userId) {
                $q->where("id", $userId);
            })
            ->where("is_active", appStatic()::ACTIVE)
            ->whereNull("deleted_at");

        if(is_null($paginatePluckOrGet)) {
            return $query->get(["id","name"]);
        }

        return $paginatePluckOrGet ? $query->paginate(maxPaginateNo()) : $query->get();

    }

    public function customGroupAndPermissions()
    {
        $hideForVendor = true;
        
        return [
            "Dashboard"=>  [
                "dashboard" => "home",
            ],
            "roles"=>[
                "all_roles"                      =>"admin.roles.index",
                "new_role"                       =>"admin.roles.create",
                "save_role"                      =>"admin.roles.store",
                "single_role"                    =>"admin.roles.show",
                "edit_role"                      =>"admin.roles.edit",
                "update_role"                    =>"admin.roles.update",
                "delete_role"                    =>"admin.roles.destroy",
            ],
            "users"=>[
                "all_users"                      =>"admin.users.index",
                "new_user"                       =>"admin.users.create",
                "save_user"                      =>"admin.users.store",
                "single_user"                    =>"admin.users.show",
                "edit_user"                      =>"admin.users.edit",
                "update_user"                    =>"admin.users.update",
                "delete_user"                    =>"admin.users.destroy"
            ],

            "brands" => [
                "all_brands"                    => "admin.brands.index",
                "new_brand"                     => "admin.brands.create",
                "save_brand"                    => "admin.brands.store",
                "single_brand"                  => "admin.brands.show",
                "edit_brand"                    => "admin.brands.edit",
                "update_brand"                  => "admin.brands.update",
                "delete_brand"                  => "admin.brands.destroy",
            ],
            "articles" => [
                "all_articles"                  => "admin.articles.index",
                "new_article"                   => "admin.articles.create",
                "save_article"                  => "admin.articles.store",
                "single_article"                => "admin.articles.show",
                "edit_article"                  => "admin.articles.edit",
                "update_article"                => "admin.articles.update",
                "delete_article"                => "admin.articles.destroy",
            ],
            "chat-categories"=>[
                "all_chat_categories"             => "admin.chat-categories.index",
                "new_chat_categories"             => "admin.chat-categories.create",
                "save_chat_categories"            => "admin.chat-categories.store",
                "single_chat_categories"          => "admin.chat-categories.show",
                "edit_chat_categories"            => "admin.chat-categories.edit",
                "update_chat_categories"          => "admin.chat-categories.update",
                "delete_chat_categories"          => "admin.chat-categories.destroy",
            ],

            "images"=>[
                "all_images"                    => "admin.images.index",
                "dall_e_2"                      => "admin.images.dallE2",
                "sd_image_2_image_multi_prompt" => "admin.images.sdImage2ImageMultiPrompt",
                "sd_image_2_image_upscale"      => "admin.images.sdImage2ImageUpscale",
            ],

            "videos"=>[
                "all_videos"       => "admin.videos.index",
                "sd_image_2_video" => "admin.videos.sdImage2Video",
            ],
        ];

    }

    public function getAllUsersExceptAdminAndAdminStaff()
    {
        $appStatic = appStatic();
        return User::query()
            ->where('user_type' , '!=', $appStatic::TYPE_ADMIN)
            ->where('user_type', '!=' , $appStatic::TYPE_ADMIN_STAFF)
            ->get();
    }

    public function updateUserMenuPermissionVersionByRoleObject(object $role): object
    {
        foreach ($role->users ?? [] as $user){
            $user->update([
                "menu_permission_version" => $user->menu_permission_version + 1
            ]);
        }

        return $role;
    }
    public function getVendorTeamQuery()
    { 
        return User::where('user_type', appStatic()::TYPE_VENDOR_TEAM);
    }

    public function getAdminStaffQuery()
    { 
        return  User::where('user_type', appStatic()::TYPE_ADMIN_STAFF);
    }

    public function getUsersForReport($query)
    {
         $date_range = request()->date_range ?? null;

        if ($date_range) {
            $dates = explode(' to ', $date_range);
            $query->whereBetween('created_at', [
                Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay(),
                Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay(),
            ]);
        }

        $branch_id = request()->branch_id ?? null;
        $status_id = request()->status_id ?? null;

        if($branch_id){
            $query->where('branch_id', $branch_id);
        }

        if($status_id){
            $query->where('account_status', $status_id);
        }

        return $query->paginate(maxPaginateNo() ?? 10);
    }

    public function getVendorCustomers()
    {
        $vendorId = vendorId();

        return User::whereIn('id', function ($query) use ($vendorId) {
            $query->select('customer_id')
                ->from('vendor_customers')
                ->where('vendor_id', $vendorId);
        })->get();
    }

}
