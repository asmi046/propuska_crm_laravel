<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventLogController;


Route::middleware('auth')->group(function () {
    Route::get('/event_log', [EventLogController::class, "index"])->name('event_log');
    Route::get('/get_event_list', [EventLogController::class, "get_event_list"])->name('get_event_list');
    Route::post('/set_event_state', [EventLogController::class, "set_event_state"])->name('set_event_state');
});
