<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpressNotificationController;


Route::middleware('auth')->group(function () {
    Route::get('/express_notification', [ExpressNotificationController::class, "express_notification"])->name('express_notification');
});
