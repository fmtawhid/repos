<?php

use Illuminate\Support\Facades\Route;
use Modules\CartManager\App\Http\Controllers\CartManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(["auth","vendor"])->prefix('cart-manager')->group(function() {

    // Carts
    Route::resource('carts', CartManagerController::class);

    Route::prefix("carts")->name("carts.")->group(function () {
        Route::post("delete-carts/{id}", [CartManagerController::class, "deleteCarts"])->name("deleteCarts");
    });
});
