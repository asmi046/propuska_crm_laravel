<?php

use App\Http\Controllers\RnisSubscribeController;
use Illuminate\Support\Facades\Route;

Route::post('/rnis_subscribe_update', [RnisSubscribeController::class, 'rnis_subscribe_update'])->name('rnis_subscribe_update');
