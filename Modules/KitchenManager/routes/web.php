<?php

use App\Http\Controllers\Admin\StatusUpdateController;
use Illuminate\Support\Facades\Route;
use Modules\KitchenManager\App\Http\Controllers\KitchenController;
use App\Http\Controllers\v1\Admin\Order\OrderController;

Route::middleware(["auth","vendor"])->prefix("vendor")->name("admin.")->group(function () {
    Route::resource("kitchens", KitchenController::class);
    Route::post("kitchens/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("kitchens.statusUpdate");

    Route::prefix("kitchen-orders")->name("kitchen_orders.")->group(function () {
        Route::get("/", [OrderController::class, "kitchenOrders"])->name("index");
    });

});
