<?php

use App\Http\Controllers\RnisSubscribeController;
use Illuminate\Support\Facades\Route;

Route::post('/rnis_subscribe_update', [RnisSubscribeController::class, 'rnis_subscribe_update'])->name('rnis_subscribe_update');
Route::get('/rnis_event_log', [RnisSubscribeController::class, 'rnis_event_log'])->name('rnis_event_log');
Route::get('/rnis_get_event_list', [RnisSubscribeController::class, 'rnis_get_event_list'])->name('rnis_get_event_list');
