<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtorsController;


Route::middleware('auth')->group(function () {
    Route::post('/debtors_add_do', [DebtorsController::class, "debtors_add_do"])->name('debtors_add_do');
    Route::get('/debtors_add', [DebtorsController::class, "debtors_add"])->name('debtors_add');
    Route::get('/debtors_dell/{id}', [DebtorsController::class, "debtors_dell"])->name('debtors_dell');
    Route::get('/debtors_dashboard', [DebtorsController::class, "debtors_dashboard"])->name('debtors_dashboard');
});
