<?php

use App\Http\Controllers\Admin\Report\ReportsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\v1\Admin\Order\OrderController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\StatusUpdateController;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Admin\Support\TicketController;
use App\Http\Controllers\Admin\Support\TicketReplyController;
use App\Http\Controllers\Admin\Subscription\SubscriptionPlanController;

Route::middleware(["auth","vendor"])->prefix("vendor")->name("admin.")->group(function () {

    Route::get("available-subscription-plans", [SubscriptionPlanController::class, "index"])->name("availablePlans");

    // Menu crud
    Route::prefix("menus")->group(function () {
        Route::resource("menus", MenuController::class);
        Route::post('menus/{id}/restore', [MenuController::class, 'restore'])
            ->name('menus.restore');

        Route::delete('menus/{id}/force-delete', [MenuController::class, 'forceDelete'])
            ->name('menus.forceDelete');


        Route::post("active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("menus.statusUpdate");

        Route::resource("item-categories", ItemCategoryController::class);
        Route::post('item-categories/{id}/restore', [ItemCategoryController::class, 'restore'])
            ->name('item-categories.restore');

        Route::delete('item-categories/{id}/force-delete', [ItemCategoryController::class, 'forceDelete'])
            ->name('item-categories.forceDelete');
        Route::post("item-categories/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("item-categories.statusUpdate");

        Route::resource("menu-items", MenuItemsController::class);
        Route::post('menu-items/{id}/restore', [MenuItemsController::class, 'restore'])->name('menu-items.restore');
        Route::delete('menu-items/{id}/force-delete', [MenuItemsController::class, 'forceDelete'])->name('menu-items.forceDelete');

        Route::post("menu-items/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("menu-items.statusUpdate");

        Route::post("delete/menu-item-variation/{id}", [MenuItemsController::class, 'deleteMenuItemVariation'])->name("delete.menuItemVariation");
    });


    Route::prefix("products")->name("products.")->group(function () {
        Route::get("{id}",[MenuItemsController::class,"show"])->name("show");
    });

    // area crud
    Route::resource('areas', AreaController::class);
    Route::post('areas/{id}/restore', [AreaController::class, 'restore'])->name('areas.restore');
    Route::delete('areas/{id}/force-delete', [AreaController::class, 'forceDelete'])->name('areas.forceDelete');

    // Status Update
    Route::post("areas/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("areas.statusUpdate");

    //Table
    Route::resource("tables", TableController::class);
    Route::post('tables/{id}/restore', [TableController::class, 'restore'])->name('tables.restore');
    Route::post('tables/{id}/force-delete', [TableController::class, 'forceDelete'])->name('tables.forceDelete');
    
    Route::post("active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("tables.statusUpdate");

    Route::get('qr-codes', [QrCodeController::class, 'index'])->name('qr-codes.index');

    // Orders
    Route::prefix("orders")->name("orders.")->group(function () {
        Route::get("/", [OrderController::class, "index"])->name("index");

        Route::post("/update-status", [OrderController::class, "updateOrderStatus"])->name("update-status");
    });

    Route::post("/update-order-product-status", [OrderController::class, "updateOrderProductStatus"])->name("update_status.order_product");


    # reports
    Route::name("reports.")->prefix("reports")->group(function () {

        Route::get('/reservations', [ReportsController::class, 'reservationsReports'])->name('reservations');
        Route::get('/reservations/export', [ReportsController::class, 'exportReservationsPdf'])->name('reservations.export');

        Route::get('/subscriptions', [ReportsController::class, 'subscriptionReports'])->name('subscriptions');
        Route::get('/subscriptions/export', [ReportsController::class, 'exportSubscriptionsPdf'])->name('subscriptions.export');

        Route::get('/items-category', [ReportsController::class, 'itemCategoryReports'])->name('items_category');
        Route::get('/items-category/export', [ReportsController::class, 'exportItemCategoryPdf'])->name('items_category.export');

        Route::get('/teams', [ReportsController::class, 'teamsReports'])->name('teams');
        Route::get('/teams/export', [ReportsController::class, 'exportTeamsPdf'])->name('teams.export');

        Route::get('/sales', [ReportsController::class, 'salesReports'])->name('sales');
        Route::get('/sales/export', [ReportsController::class, 'exportSalesPdf'])->name('sales.export');

        Route::get('/items', [ReportsController::class, 'itemReports'])->name('items');
        Route::get('/items/export', [ReportsController::class, 'exportItemsPdf'])->name('items.export');
    });
});
