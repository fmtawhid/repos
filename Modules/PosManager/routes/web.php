<?php

use Illuminate\Support\Facades\Route;
use Modules\PosManager\App\Http\Controllers\PosManagerController;
use App\Http\Controllers\Admin\PosController;
use Modules\PosManager\App\Http\Controllers\PosDashboardController;
use Modules\PosManager\App\Http\Controllers\PosOrderController;


//=================================================
// POS
//=================================================
Route::prefix("admin/pos-manager")->name("pos.")->middleware(["web", "auth","vendor"])->group(function () {

    
    Route::get('/shops', [PosDashboardController::class, 'shops'])->name('shops');

    Route::prefix("dashboard")->group(function () {
        Route::get("/", [PosDashboardController::class, "index"])->name("dashboard");
    });

    Route::get("/pos-order-by-qrcode/{code}", [PosDashboardController::class, "newPosOrderByQrCode"])->name("qrcode.pos_order");

    // Customer
    Route::prefix("customer")->name("customer.")->group(function () {
        Route::post("register", [PosDashboardController::class, "register"])->name("register");
    });

    // Order
    Route::prefix("order")->name("order.")->group(function () {
        // Pos Order
        Route::post("place-order", [PosOrderController::class, "placeOrder"])->name("placeOrder");
        Route::post("receive-bill", [PosOrderController::class, "receiveBill"])->name("receiveBill");
    });
});


//=================================================
// POS end
//=================================================

