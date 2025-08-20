<?php

namespace App\Services\Models\Permission;

use App\Models\Permission;
use Illuminate\Support\Facades\Route;

/**
 * Class PermissionService.
 */
class PermissionService
{
    public function getAll(
        $isPaginateOrGet = false,
    )
    {
        $query = Permission::query();

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }


    public function storeRoutes($request)
    {
        $routes = Route::getRoutes();
        $data = [];

        $permissions = [];

        foreach ($routes as $key=>$route) {

            $routePrefix = $route->getPrefix();
            $routeName   = $route->getName();

            if(!empty($routePrefix)) {
                $prefixExplode = explode("/", $routePrefix);
                $mainPrefix = "";

                if(count($prefixExplode) > 1){
                    $mainPrefix = $prefixExplode[0];
                }else{
                    $mainPrefix = $routePrefix;
                }

//                if(in_array($mainPrefix, $this->allowedPrefix())){

                $explode = explode("/",$route->uri);

                $method = $route->methods()[0] ?? null;

                $payloads = [
                    'display_title'      => ucfirst(textReplace($route->getName(),"."," ")) ,
                    'route'              => $route->getName() ?? $route->uri(),
                    'url'                => $route->uri(),
                    'is_sidebar_menu'    => strpos($route->getName(),".index") ? 1 : 0,
                    'method_type'        => $method,
                ];

                $permissions[] = Permission::query()->updateOrCreate($payloads);
            }
        }

        return $permissions;
    }

    public function vendorPermissionsRoutes() : array
    {

        return [
            "dashboard" => [
                'show_dashboard' => 'admin.dashboard',
            ],

            'role' => [
                'all_roles'   => 'admin.roles.index',
                'new_roles'  => 'admin.roles.create',
                'store_roles'   => 'admin.roles.store',
                'show_roles'    => 'admin.roles.show',
                'edit_roles'    => 'admin.roles.edit',
                'update_roles'  => 'admin.roles.update',
                'delete_roles' => 'admin.roles.destroy',
            ],

            'Employees' => [
                'all_employees'           => 'admin.users.index',
                'new_employee'          => 'admin.users.create',
                'save_employee'           => 'admin.users.store',
                'show_employee_record'            => 'admin.users.show',
                'edit_employee'            => 'admin.users.edit',
                'update_employee'          => 'admin.users.update',
                'delete_employee'         => 'admin.users.destroy',
                'update_balance_users' => 'admin.users.updateBalance',
            ],

            // Media Manager
            'media_managers' => [
                'index_media_managers'   => 'admin.media-managers.index',
                'create_media_managers'  => 'admin.media-managers.create',
                'store_media_managers'   => 'admin.media-managers.store',
                'show_media_managers'    => 'admin.media-managers.show',
                'edit_media_managers'    => 'admin.media-managers.edit',
                'update_media_managers'  => 'admin.media-managers.update',
                'destroy_media_managers' => 'admin.media-managers.destroy',
            ],

            // Menu
            'menus' => [
                'all_menus'          => 'admin.menus.index',
                'add_menus'          => 'admin.menus.create',
                'store_menu'         => 'admin.menus.store',
                'show_menus'         => 'admin.menus.show',
                'edit_menus'         => 'admin.menus.edit',
                'update_menus'       => 'admin.menus.update',
                'delete_menus'       => 'admin.menus.destroy',
                'menu_status_update' => 'admin.menus.statusUpdate',
            ],

            // Item categories
            'item_categories' => [
                'all_item_categories'         => 'admin.item-categories.index',
                'add_item_categories'         => 'admin.item-categories.create',
                'store_item_category'         => 'admin.item-categories.store',
                'show_item_categories'        => 'admin.item-categories.show',
                'edit_item_categories'        => 'admin.item-categories.edit',
                'update_item_category'        => 'admin.item-categories.update',
                'delete_item_categories'      => 'admin.item-categories.destroy',
                'item_category_status_update' => 'admin.item-categories.statusUpdate',
            ],

            // Menu Items
            'menu_items' => [
                'all_menu_items'             => 'admin.menu-items.index',
                'add_menu_items'             => 'admin.menu-items.create',
                'store_menu_item'            => 'admin.menu-items.store',
                'show_menu_items'            => 'admin.menu-items.show',
                'edit_menu_items'            => 'admin.menu-items.edit',
                'update_menu_items'          => 'admin.menu-items.update',
                'delete_menu_items'          => 'admin.menu-items.destroy',
                'menu_item_status_update'    => 'admin.menu-items.statusUpdate',
                'delete_menu_item_variation' => 'admin.delete.menuItemVariation',
                'POS_Item_Quick_view'        => 'admin.products.show',
            ],

            // Manage Branches
            'branches' => [
                'index_branches'        => 'admin.branches.index',
                'create_branches'       => 'admin.branches.create',
                'store_branches'        => 'admin.branches.store',
                'show_branches'         => 'admin.branches.show',
                'edit_branches'         => 'admin.branches.edit',
                'update_branches'       => 'admin.branches.update',
                'destroy_branches'      => 'admin.branches.destroy',
                'update_branch_status'  => 'admin.branches.statusUpdate',
            ],

            // Manage Areas
            'areas' => [
                'all_areas'          => 'admin.areas.index',
                'add_areas'          => 'admin.areas.create',
                'store_area'         => 'admin.areas.store',
                'show_areas'         => 'admin.areas.show',
                'edit_areas'         => 'admin.areas.edit',
                'update_area'        => 'admin.areas.update',
                'delete_areas'       => 'admin.areas.destroy',
                'area_status_update' => 'admin.areas.statusUpdate',
            ],

            // Manage Tables
            'tables' => [
                'all_tables'          => 'admin.tables.index',
                'add_tables'          => 'admin.tables.create',
                'store_table'         => 'admin.tables.store',
                'show_tables'         => 'admin.tables.show',
                'edit_tables'         => 'admin.tables.edit',
                'update_table'        => 'admin.tables.update',
                'delete_tables'       => 'admin.tables.destroy',
                'table_status_update' => 'admin.tables.statusUpdate',
            ],

            'qr_codes' => [
                'table_qr_codes' => 'admin.qr-codes.index',
            ],

            'status_update' => [
                'status_update' => 'admin.status.update',
            ],

            'settings' => [
                'index_settings'       => 'admin.settings.index',
                'create_settings'      => 'admin.settings.create',
                'store_settings'       => 'admin.settings.store',
                'show_settings'        => 'admin.settings.show',
                'edit_settings'        => 'admin.settings.edit',
                'update_settings'      => 'admin.settings.update',
                'destroy_settings'     => 'admin.settings.destroy',
                'credentials_settings' => 'admin.settings.credentials',
            ],


            'subscription_plans' => [
                'index_subscription_plans' => 'admin.subscription-plans.index',
                'create_subscription_plans' => 'admin.subscription-plans.create',
                'show_subscription_plans' => 'admin.subscription-plans.show',
                'get_price_subscription_plans' => 'admin.subscription-plans.get-price',
            ],

            'plan_histories' => [
                'index_plan_histories' => 'admin.plan-histories.index',
                'show_plan_histories' => 'admin.plan-histories.show',
            ],

            'plan_invoice' => [
                'index_plan_invoice' => 'admin.plan-invoice.index',
                'download_plan_invoice' => 'admin.plan-invoice.download',
            ],

            'subscription_settings' => [
                'index_subscription_settings'                 => 'admin.subscription-settings.index',
                'store_gateway_product_subscription_settings' => 'admin.subscription-settings.store.gateway.product',
            ],

            'payment_requests' => [
                'index_payment_requests'    => 'admin.payment-requests.index',
                'feedback_payment_requests' => 'admin.payment-requests.feedback',
            ],

            'kitchens' => [
                'index_kitchens'         => 'admin.kitchens.index',
                'create_kitchens'        => 'admin.kitchens.create',
                'store_kitchens'         => 'admin.kitchens.store',
                'show_kitchens'          => 'admin.kitchens.show',
                'edit_kitchens'          => 'admin.kitchens.edit',
                'update_kitchens'        => 'admin.kitchens.update',
                'destroy_kitchens'       => 'admin.kitchens.destroy',
                'status_update_kitchens' => 'admin.kitchens.statusUpdate',
            ],

            'change_currency' => [
                'change_currency' => 'backend.changeCurrency',
            ],

            'change_language' => [
                'change_language' => 'backend.changeLanguage',
            ],

            'customers' => [
                'index_customers'   => 'admin.customers.index',
                'create_customers'  => 'admin.customers.create',
                'store_customers'   => 'admin.customers.store',
                'show_customers'    => 'admin.customers.show',
                'edit_customers'    => 'admin.customers.edit',
                'update_customers'  => 'admin.customers.update',
                'destroy_customers' => 'admin.customers.destroy',
                'export_customers'  => 'admin.customers.export',
            ],

            'carts' => [
                'all_carts'         => 'carts.index',
                'create_carts'      => 'carts.create',
                'add_to_cart'       => 'carts.store',
                'show_cart'         => 'carts.show',
                'edit_cart'         => 'carts.edit',
                'update_cart'       => 'carts.update',
                'delete_cart'       => 'carts.destroy',
                'delete_full_carts' => 'carts.deleteCarts',
            ],

            'pos_manager' => [
                'pos_dashboard'               => 'pos.dashboard',
                'qr_code_scan'                => 'pos.qrcode.pos_order',
                'add_new_customer'            => 'pos.customer.register',
                'order_place'                 => 'pos.order.place-order',
                "main_order_status_update"    => "admin.orders.update-status",
                "order_product_status_update" => "admin.update_status.order_product",
            ],

            'orders' => [
                'all_orders'                  => 'admin.orders.index',
                'kitchen_orders'              => 'admin.kitchen_orders.index',
                'update_order_status'         => 'admin.orders.update-status',
                'update_order_product_status' => 'admin.update_status.order_product',
            ],

            'reports' => [
                'subscriptions_reports'  => 'admin.reports.subscriptions',
                'sales_reports'          => 'admin.reports.sales',
                'items_reports'          => 'admin.reports.items',
                'items_category_reports' => 'admin.reports.items_category',
            ],

            'support_categories' => [
                'index_support_categories' => 'admin.support-categories.index',
                'create_support_categories' => 'admin.support-categories.create',
                'show_support_categories' => 'admin.support-categories.show',
            ],

            'support_priorities' => [
                'index_support_priorities' => 'admin.support-priorities.index',
                'create_support_priorities' => 'admin.support-priorities.create',
                'show_support_priorities' => 'admin.support-priorities.show',
            ],

            'support_tickets' => [
                'index_support_tickets' => 'admin.support-tickets.index',
                'create_support_tickets' => 'admin.support-tickets.create',
                'store_support_tickets' => 'admin.support-tickets.store',
                'show_support_tickets' => 'admin.support-tickets.show',
                'edit_support_tickets' => 'admin.support-tickets.edit',
                'update_support_tickets' => 'admin.support-tickets.update',
                'destroy_support_tickets' => 'admin.support-tickets.destroy',
                'reply_support_tickets' => 'admin.support-tickets.reply',
            ],

            'support_replies' => [
                'index_support_replies' => 'admin.support-replies.index',
                'create_support_replies' => 'admin.support-replies.create',
                'store_support_replies' => 'admin.support-replies.store',
                'show_support_replies' => 'admin.support-replies.show',
                'edit_support_replies' => 'admin.support-replies.edit',
                'update_support_replies' => 'admin.support-replies.update',
                'destroy_support_replies' => 'admin.support-replies.destroy',
            ],
        ];
    }

    public function demoRoutes(): array
    {
        return [
            "admin.dashboard",
            "admin.profile",
            "admin.login",
            "login",
            "logout",
        ];
    }
}
