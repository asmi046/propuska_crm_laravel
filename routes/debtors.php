<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtorsController;


Route::middleware('auth')->group(function () {
    Route::get('/debtors_add', [DebtorsController::class, "debtors_add"])->name('debtors_add');
    Route::get('/debtors_dashboard', [DebtorsController::class, "debtors_dashboard"])->name('debtors_dashboard');
});
