<?php

namespace App\Services\Model\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Scopes\UserIdScopeTrait;
use App\Services\Models\Permission\PermissionService;
use App\Traits\Models\Status\IsActiveTrait;
use App\Traits\Models\User\UserMenuPermissionTrait;
use App\Traits\Models\User\UserTrait;
use Illuminate\Database\Eloquent\Model;

class RoleService
{
    use UserMenuPermissionTrait;
    use IsActiveTrait;
    use UserTrait;
    use UserIdScopeTrait;

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
    public function getAll(
        $paginatePluckOrGet = null,
        $onlyActive         = null,
        $eagerLoad  = []
    ) {

        $query = Role::query();

        // Eager Load
        (!empty($eagerLoad) ? $eagerLoad = array_merge($eagerLoad, ["createdBy", "updatedBy"]) : true);

        $query->with($eagerLoad)->latest();

        // Bind Merchant ID or Super Admin ID

        // Binding Merchant ID
        if (isVendor() || isVendorTeam()) {
            $query->userId(getUserParentId());
        } else {
            $user_id = isAdmin() ? userID() : getUserParentId();

            $query->userId($user_id);
        }

        // Active in-active
        if (!empty($onlyActive)) {
            // Only active categories or not active categories
            ($onlyActive ? $query->isActive() : $query->isActive(false));
        }

        // Pluck Data Returning
        if (is_null($paginatePluckOrGet)) {
            return $query->pluck("id", "title");
        }

        return $paginatePluckOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }


    /**
     * Role Store
     * */
    public function store($payloads): Model
    {

        return Role::query()->create($payloads);
    }

    # Permissions Delete
    public function permissionDeletes($role)
    {
        $role->permissions()->delete();
    }

    #Role Permission Save
    public function rolePermissionStore($role, array $permission_ids): Model
    {
        foreach ($permission_ids as $key => $permission_id) {

            RolePermission::query()->create([
                "role_id"       => $role->id,
                "permission_id" => $permission_id
            ]);
        }

        return $role;
    }

    public function findById($id)
    {
        return Role::query()->with("permissions")->findOrFail($id);
    }


    public function getPermissionByRoute(string $route)
    {
        if (isCacheExists($route)) {
            $cachePermission = cache()->get($route);
        } else {
            $permission = Permission::query()->where("route", $route)->firstOrFail();

            setCacheData($permission->route, $permission);
            $cachePermission = cache()->get($route);
        }

        return $cachePermission->id;
    }

    #Role Update
    public function update($role, $payloads): Model
    {
        $role->update($payloads);

        return $role;
    }


    # Role User Menu Permission update
    public function roleUsersMenuPermissionIncrease($role)
    {
        $users = $role->users;

        if ($users && $users->count() > 0) {
            foreach ($users as $key => $user) {

                // User Menu Permission Update
                self::increaseUserMenuPermissions($user);
            }
        }

        return $role;
    }

    public function adminCustomRoutes()
    {
        if (isVendor() || isVendorTeam())
        {
            return $this->vendorPermissionsRoutes();
        }
        
        // Admin
        return [

            "dashboard" => [
                'show_dashboard' => 'admin.dashboard',
            ],

            // manage Vendors
            'vendors' => [
                'all_vendors'   => 'admin.merchants.index',
                'add_vendors'   => 'admin.merchants.create',
                'store_vendor'  => 'admin.merchants.store',
                'show_vendors'  => 'admin.merchants.show',
                'edit_vendors'  => 'admin.merchants.edit',
                'update_vendors'=> 'admin.merchants.update',
                'delete_vendors'=> 'admin.merchants.destroy',
                'export_vendors'=> 'admin.merchants.export',
            ],

            'permissions' => [
                'index_permissions'  => 'admin.permissions.index',
                'create_permissions' => 'admin.permissions.create',
                'store_permissions'  => 'admin.permissions.store',
                'show_permissions'  => 'admin.permissions.show',
                'edit_permissions'   => 'admin.permissions.edit',
                'update_permissions' => 'admin.permissions.update',
                'destroy_permissions' => 'admin.permissions.destroy',
            ],

            'role' => [
                'index_roles' => 'admin.roles.index',
                'create_roles' => 'admin.roles.create',
                'store_roles' => 'admin.roles.store',
                'show_roles' => 'admin.roles.show',
                'edit_roles' => 'admin.roles.edit',
                'update_roles' => 'admin.roles.update',
                'destroy_roles' => 'admin.roles.destroy',
            ],

            'Staff' => [
                'index_users' => 'admin.users.index',
                'create_users' => 'admin.users.create',
                'store_users' => 'admin.users.store',
                'show_users' => 'admin.users.show',
                'edit_users' => 'admin.users.edit',
                'update_users' => 'admin.users.update',
                'destroy_users' => 'admin.users.destroy',
                'update_balance_users' => 'admin.users.updateBalance',
            ],
                     
            'languages' => [
                'all_languages'    => 'admin.languages.index',
                'add_languages'    => 'admin.languages.create',
                'store_languages'  => 'admin.languages.store',
                'show_languages'   => 'admin.languages.show',
                'edit_languages'   => 'admin.languages.edit',
                'delete_languages' => 'admin.languages.destroy',
            ],

            'localizations' => [
                'store_localizations' => 'admin.localizations.store',
                'show_localizations'  => 'admin.localizations.show',
            ],

            'currencies' => [
                'all_currencies'    => 'admin.currencies.index',
                'add_currencies'    => 'admin.currencies.create',
                'store_currencies'  => 'admin.currencies.store',
                'show_currencies'   => 'admin.currencies.show',
                'edit_currencies'   => 'admin.currencies.edit',
                'delete_currencies' => 'admin.currencies.destroy',
            ],

            'uppy' => [
                'all_uppy'            => 'admin.uppy.index',
                'store_uppy'          => 'admin.uppy.store',
                'uppy_selected_files' => 'admin.uppy.selectedFiles',
                'uppy_delete'         => 'admin.uppy.delete',
            ],

            'support-categories' => [
                'all_support-categories'    => 'admin.support-categories.index',
                'add_support-categories'    => 'admin.support-categories.create',
                'store_support-categories'  => 'admin.support-categories.store',
                'show_support-categories'   => 'admin.support-categories.show',
                'edit_support-categories'   => 'admin.support-categories.edit',
                'delete_support-categories' => 'admin.support-categories.destroy',
            ],

            'support-priorities'            => [
                'all_support-priorities'    => 'admin.support-priorities.index',
                'add_support-priorities'    => 'admin.support-priorities.create',
                'store_support-priorities'  => 'admin.support-priorities.store',
                'show_support-priorities'   => 'admin.support-priorities.show',
                'edit_support-priorities'   => 'admin.support-priorities.edit',
                'delete_support-priorities' => 'admin.support-priorities.destroy',
            ],

            'support-tickets' => [
                'all_support-tickets'    => 'admin.support-tickets.index',
                'add_support-tickets'    => 'admin.support-tickets.create',
                'store_support-tickets'  => 'admin.support-tickets.store',
                'show_support-tickets'   => 'admin.support-tickets.show',
                'edit_support-tickets'   => 'admin.support-tickets.edit',
                'delete_support-tickets' => 'admin.support-tickets.destroy',
            ],

            'subscription-plans' => [
                'all_subscription-plans'    => 'admin.subscription-plans.index',
                'add_subscription-plans'    => 'admin.subscription-plans.create',
                'store_subscription-plans'  => 'admin.subscription-plans.store',
                'show_subscription-plans'   => 'admin.subscription-plans.show',
                'edit_subscription-plans'   => 'admin.subscription-plans.edit',
                'delete_subscription-plans' => 'admin.subscription-plans.destroy',
            ],


            'payment_gateways' => [
                'index_payment_gateways' => 'admin.payment-gateways.index',
                'create_payment_gateways' => 'admin.payment-gateways.create',
                'store_payment_gateways' => 'admin.payment-gateways.store',
                'show_payment_gateways' => 'admin.payment-gateways.show',
                'edit_payment_gateways' => 'admin.payment-gateways.edit',
                'update_payment_gateways' => 'admin.payment-gateways.update',
                'destroy_payment_gateways' => 'admin.payment-gateways.destroy',
            ],

            'plan-histories' => [
                'all_plan-histories' => 'admin.plan-histories.index',
            ],

            'System_Update'=>[
                'Health_Check'           => 'admin.systemUpdate.health-check',
                'Update_System'          => 'admin.systemUpdate.update',
                'Check_File_Permission'  => 'admin.systemUpdate.file-permission',
                'One_Click_Update'       => 'admin.systemUpdate.oneClickUpdate',
                'Manual_Update_System'   => 'admin.systemUpdate.update-version',
            ],
                   
            'offline_payment_methods' => [
                'index_offline_payment_methods' => 'admin.offline-payment-methods.index',
                'create_offline_payment_methods' => 'admin.offline-payment-methods.create',
                'store_offline_payment_methods' => 'admin.offline-payment-methods.store',
                'show_offline_payment_methods' => 'admin.offline-payment-methods.show',
                'edit_offline_payment_methods' => 'admin.offline-payment-methods.edit',
                'update_offline_payment_methods' => 'admin.offline-payment-methods.update',
                'destroy_offline_payment_methods' => 'admin.offline-payment-methods.destroy',
            ],

            'subscription_settings' => [
                'index_subscription_settings' => 'admin.subscription-settings.index',
                'store_gateway_product_subscription_settings' => 'admin.subscription-settings.store.gateway.product',
            ],

            'utilities' => [
                'index_utilities' => 'admin.utilities.index',
                'clear_cache_utilities' => 'admin.utilities.clear-cache',
                'clear_log_utilities' => 'admin.utilities.clear-log',
                'cron_list_utilities' => 'admin.utilities.cron-list',
            ],
        ];
    }


    public function vendorPermissionsRoutes()
    {
        return (new PermissionService())->vendorPermissionsRoutes();
    }

    public function customerTeamRoutes()
    {
        return [];
    }
}
