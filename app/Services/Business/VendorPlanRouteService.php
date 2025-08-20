<?php

namespace App\Services\Business;

/**
 * Class CustomerPlanRouteService.
 */
class VendorPlanRouteService
{

    public function vendorPlanRoutes(): array
    {
        $roles              = $this->getRolesRoutes();
        $users              = $this->getUsersRoutes();
        $tickets            = $this->getTicketsRoutes();
        $commonRoutes       = $this->getCommonRoutes();
        $permissions        = $this->getPermissionsRoutes();

        return array_merge(
            $commonRoutes,
            $roles,
            $permissions,
            $users,
            $tickets,
        );
    }

    public function getRolesRoutes(): array
    {
        return [
            'admin.roles.index'    => 'allow_team',
            'admin.roles.create'   => 'allow_team',
            'admin.roles.store'    => 'allow_team',
            'admin.roles.show'     => 'allow_team',
            'admin.roles.edit'     => 'allow_team',
            'admin.roles.update'   => 'allow_team',
            'admin.roles.destroy'  => 'allow_team',
        ];
    }

    public function getPermissionsRoutes(): array{
        return [            
            'admin.permissions.index'    => 'allow_team',
            'admin.permissions.create'   => 'allow_team',
            'admin.permissions.store'    => 'allow_team',
            'admin.permissions.show'     => 'allow_team',
            'admin.permissions.edit'     => 'allow_team',
            'admin.permissions.update'   => 'allow_team',
            'admin.permissions.destroy'  => 'allow_team',
        ];
    }


    public function getUsersRoutes(): array
    {
        return [
            'admin.users.index'    => 'allow_team',
            'admin.users.create'   => 'allow_team',
            'admin.users.store'    => 'allow_team',
            'admin.users.show'     => 'allow_team',
            'admin.users.edit'     => 'allow_team',
            'admin.users.update'   => 'allow_team',
            'admin.users.destroy'  => 'allow_team',
        ];
    }

    public function getTicketsRoutes(): array
    {
        return [
            'admin.support-tickets.index'    => 'has_free_support',
            'admin.support-tickets.create'   => 'has_free_support',
            'admin.support-tickets.store'    => 'has_free_support',
            'admin.support-tickets.show'     => 'has_free_support',
            'admin.support-tickets.edit'     => 'has_free_support',
            'admin.support-tickets.update'   => 'has_free_support',
            'admin.support-tickets.destroy'  => 'has_free_support',

            // Support Categories
            "admin.support-categories.index",
            "admin.support-priorities.index",

            // Replies
            'admin.support-replies.index'    => 'has_free_support',
            'admin.support-replies.create'   => 'has_free_support',
            'admin.support-replies.store'    => 'has_free_support',
            'admin.support-replies.show'     => 'has_free_support',
            'admin.support-replies.edit'     => 'has_free_support',
            'admin.support-replies.update'   => 'has_free_support',
            'admin.support-replies.destroy'  => 'has_free_support',

            // Individual Reply View
            "admin.support-tickets.reply"    => "has_free_support"
        ];
    }

    public function getCommonRoutes(): array
    {
        return [
            'pos.dashboard',
            "admin.profile",
            "admin.profile",
            "admin.info-update",
            "admin.change-password",
            "admin.users.updateBalance",
            "admin.balance-render",

            // Subscriptions
            "admin.subscription-plans.index",
            "admin.subscription-plans.package-update",
            "admin.subscription-plans.get-price",

            // Plan
            "admin.plan-histories.index",
            "admin.plan-histories.show",
            "admin.plan-invoice.index",
            "admin.plan-invoice.download",



            'admin.menus.index' => 'all_menus',
            'admin.menus.create' => 'add_menus',
            'admin.menus.store' => 'store_menu',
            'admin.menus.show' => 'show_menus',
            'admin.menus.edit' => 'edit_menus',
            'admin.menus.update' => 'update_menus',
            'admin.menus.destroy' => 'delete_menus',
            'admin.menus.statusUpdate' => 'menu_status_update',

            'admin.item-categories.index' => 'all_item_categories',
            'admin.item-categories.create' => 'add_item_categories',
            'admin.item-categories.store' => 'store_item_category',
            'admin.item-categories.show' => 'show_item_categories',
            'admin.item-categories.edit' => 'edit_item_categories',
            'admin.item-categories.update' => 'update_item_category',
            'admin.item-categories.destroy' => 'delete_item_categories',
            'admin.item-categories.statusUpdate' => 'item_category_status_update',

            'admin.menu-items.index' => 'all_menu_items',
            'admin.menu-items.create' => 'add_menu_items',
            'admin.menu-items.store' => 'store_menu_item',
            'admin.menu-items.show' => 'show_menu_items',
            'admin.menu-items.edit' => 'edit_menu_items',
            'admin.menu-items.update' => 'update_menu_items',
            'admin.menu-items.destroy' => 'delete_menu_items',
            'admin.menu-items.statusUpdate' => 'menu_item_status_update',
            'admin.delete.menuItemVariation' => 'delete_menu_item_variation',


            'admin.merchants.index' => 'all_vendors',
            'admin.merchants.create' => 'add_vendors',
            'admin.merchants.store' => 'store_vendor',
            'admin.merchants.show' => 'show_vendors',
            'admin.merchants.edit' => 'edit_vendors',
            'admin.merchants.update' => 'update_vendors',
            'admin.merchants.destroy' => 'delete_vendors',
            'admin.merchants.export' => 'export_vendors',

            'admin.areas.index' => 'all_areas',
            'admin.areas.create' => 'add_areas',
            'admin.areas.store' => 'store_area',
            'admin.areas.show' => 'show_areas',
            'admin.areas.edit' => 'edit_areas',
            'admin.areas.update' => 'update_area',
            'admin.areas.destroy' => 'delete_areas',
            'admin.areas.statusUpdate' => 'area_status_update',

            'admin.tables.index' => 'all_tables',
            'admin.tables.create' => 'add_tables',
            'admin.tables.store' => 'store_table',
            'admin.tables.show' => 'show_tables',
            'admin.tables.edit' => 'edit_tables',
            'admin.tables.update' => 'update_table',
            'admin.tables.destroy' => 'delete_tables',
            'admin.tables.statusUpdate' => 'table_status_update',

            'admin.pos_manager.dashboard' => 'dashboard_pos_manager',
            'admin.pos-manager.pos-order-by-qrcode' => 'qrcode_pos_order',
            'admin.pos-manager.customer.register' => 'register_pos_customer',
            'admin.pos-manager.order.place-order' => 'place_order_pos_order',


            'orders.index' => 'index_orders',
            'orders.update-status' => 'update_status_orders',
            'update_status.order_product' => 'update_status_order_product',

            'kitchens.index' => 'index_kitchens',
            'kitchens.create' => 'create_kitchens',
            'kitchens.store' => 'store_kitchens',
            'kitchens.show' => 'show_kitchens',
            'kitchens.edit' => 'edit_kitchens',
            'kitchens.update' => 'update_kitchens',
            'kitchens.destroy' => 'destroy_kitchens',
            'kitchens.statusUpdate' => 'status_update_kitchens',

            'kitchen_orders.index' => 'index_kitchen_orders',

            'branches.index' => 'index_branches',
            'branches.create' => 'create_branches',
            'branches.store' => 'store_branches',
            'branches.show' => 'show_branches',
            'branches.edit' => 'edit_branches',
            'branches.update' => 'update_branches',
            'branches.destroy' => 'destroy_branches',
            'branches.statusUpdate' => 'statusUpdate_branches',



        
        ];
    }

}
