<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TechInspectionController;


Route::middleware('auth')->group(function () {
    Route::get('/to_alert_list', [TechInspectionController::class, "index"])->name('to_alert_list');
    Route::get('/get_alert_list', [TechInspectionController::class, "get_alert_list"])->name('get_alert_list');
    Route::get('/to_alert_delete/{id}', [TechInspectionController::class, "delete_elem"])->name('to_alert_delete');
    Route::post('/to_alert_add/{number}', [TechInspectionController::class, "add_to"])->name('to_alert_add');
});
