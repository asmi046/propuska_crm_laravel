<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StsController;
use App\Http\Controllers\FineController;


Route::middleware('auth')->group(function () {
    Route::get('/sts_alert_list', [StsController::class, "index"])->name('sts_alert_list');
    Route::get('/get_sts_alert_list', [StsController::class, "get_alert_list"])->name('get_sts_alert_list');
    Route::get('/sts_alert_delete/{id}', [StsController::class, "delete_elem"])->name('sts_alert_delete');
    Route::post('/sts_alert_add', [StsController::class, "add_sts"])->name('sts_alert_add');

    Route::get('/fine_alert_list', [FineController::class, "index"])->name('fine_alert_list');
    Route::get('/get_fine_alert_list', [FineController::class, "get_alert_list"])->name('get_fine_alert_list');
    Route::get('/fine_alert_delete/{id}', [FineController::class, "delete_elem"])->name('fine_alert_delete');
    Route::post('/fine_alert_add', [FineController::class, "add_to"])->name('fine_alert_add');
});
