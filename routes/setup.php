<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Install\InstallController;

/*
|--------------------------------------------------------------------------
| Install Routes
|--------------------------------------------------------------------------
|
| This route is responsible for handling the installation process
| 
*/

Route::get('/', [InstallController::class, 'init'])->name('installation.init');

Route::get('/checklist', [InstallController::class, 'checklist'])->name('installation.checklist');

Route::get('/database-setup/{error?}', [InstallController::class, 'databaseSetup'])->name('installation.dbSetup');
Route::post('/database-setup', [InstallController::class, 'storeDatabaseSetup'])->name('installation.storeDbSetup');

Route::get('/db-migration', [InstallController::class, 'dbMigration'])->name('installation.migration');
Route::get('/run-db-migration/{demo?}', [InstallController::class, 'runDbMigration'])->name('installation.runMigration');

Route::get('/admin-configuration', [InstallController::class, 'storeAdminForm'])->name('installation.storeAdminForm');
Route::post('/admin-configuration', [InstallController::class, 'storeAdmin'])->name('installation.storeAdmin');

