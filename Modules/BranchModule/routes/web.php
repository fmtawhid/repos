<?php

use App\Http\Controllers\Admin\StatusUpdateController;
use Illuminate\Support\Facades\Route;
use Modules\BranchModule\App\Http\Controllers\BranchController;

Route::middleware(["auth","vendor"])->prefix("vendor")->name("admin.")->group(function () {
    Route::resource("branches", BranchController::class);
        Route::post("branches/active-status-update/{id}", [StatusUpdateController::class, "updateActiveStatus"])->name("branches.statusUpdate");
});
