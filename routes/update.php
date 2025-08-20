<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Install\UpdateController;
use App\Http\Controllers\Update\AppUpdateController;


Route::get('/', [UpdateController::class, 'init'])->name('update.init');
Route::get('/complete', [UpdateController::class, 'complete'])->name('update.complete');


Route::get('/update', [AppUpdateController::class, 'index'])->name('update.index');
Route::post('/update/upload', [AppUpdateController::class, 'upload'])->name('update.upload');