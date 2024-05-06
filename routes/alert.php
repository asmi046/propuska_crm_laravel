<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlertController;


Route::middleware('auth')->group(function () {
    Route::post('/send_alert', [AlertController::class, "send_alert"])->name('send_alert');
});
