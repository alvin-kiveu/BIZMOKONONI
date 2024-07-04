<?php

use App\Http\Controllers\Install;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Installation Web Routes
|--------------------------------------------------------------------------
|
| Routes related to installation of the software
|
*/

Route::get('/install-start', [Install\InstallController::class, 'index'])->name('install.index');
Route::get('/install/check-server', [Install\InstallController::class, 'checkServer'])->name('install.checkServer');
Route::get('/install/details', [Install\InstallController::class, 'details'])->name('install.details');
Route::post('/install/post-details', [Install\InstallController::class, 'postDetails'])->name('install.postDetails');
Route::post('/install/install-alternate', [Install\InstallController::class, 'installAlternate'])->name('install.installAlternate');
Route::get('/install/success', [Install\InstallController::class, 'success'])->name('install.success');

Route::get('/install/update', [Install\InstallController::class, 'updateConfirmation'])->name('install.updateConfirmation');
Route::post('/install/update', [Install\InstallController::class, 'update'])->name('install.update');
