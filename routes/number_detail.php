<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumberDetailController;


Route::middleware('auth')->group(function () {
    Route::get('/check_number/{number?}', [NumberDetailController::class, "check_number"])->name('check_number');
    Route::get('/update_number_info/{id}', [NumberDetailController::class, "update_number_info"])->name('update_number_info');
    Route::get('/check_many_numbers', [NumberDetailController::class, "check_many_numbers"])->name('check_many_numbers');
    Route::get('/mass_check_pass_info/{number}', [NumberDetailController::class, "mass_check_pass_info"])->name('mass_check_pass_info');
    Route::get('/updet_by_numbers', [NumberDetailController::class, "updet_by_numbers"])->name('updet_by_numbers');
    Route::get('/update_by_numbers_do/{pass}', [NumberDetailController::class, "update_by_numbers_do"])->name('update_by_numbers_do');
});
