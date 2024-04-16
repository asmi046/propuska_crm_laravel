<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumberDetailController;


Route::middleware('auth')->group(function () {
    Route::get('/check_number/{number?}', [NumberDetailController::class, "check_number"])->name('check_number');
});
