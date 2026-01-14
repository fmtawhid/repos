<?php

use App\Http\Controllers\Admin\StatusUpdateController;
use Illuminate\Support\Facades\Route;
use Modules\ReservationManager\App\Http\Controllers\ReservationManagerController;

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

Route::group([], function () {
    Route::resource('reservationmanager', ReservationManagerController::class)->names('reservationmanager');

Route::post('reservationmanager/{id}/restore', [ReservationManagerController::class, 'restore'])->name('reservationmanager.restore');
Route::post('reservationmanager/{id}/force-delete', [ReservationManagerController::class, 'forceDelete'])->name('reservationmanager.forceDelete');



    Route::get('reservationmanager/table/branch/{branch_id}', [ReservationManagerController::class, 'getTableListByBranchId'])
        ->name('reservationmanager.table_list_by_branch_id');

    Route::get('reservationmanager/area-list/branch/{branch_id}', [ReservationManagerController::class,'getAreaListByBranchId'])
        ->name('reservationmanager.area_list_by_branch_id');


    Route::get('reservationmanager/table-list/area/{area_id}', [ReservationManagerController::class, 'getTableListByAreaId'])
        ->name('reservationmanager.table_list_by_area_id');

    Route::post("reservationmanager/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])
        ->name("reservationmanager.statusUpdate");
});
