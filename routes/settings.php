<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;

Route::middleware('auth')->group(function () {
    Route::get('/send_api_meaasge_get', [SettingsController::class, "send_api_meaasge_get"])->name('send_api_meaasge_get');
    Route::post('/send_api_meaasge_set/{value}', [SettingsController::class, "send_api_meaasge_set"])->name('send_api_meaasge_set');
});

