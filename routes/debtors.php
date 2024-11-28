<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtorsController;


Route::middleware('auth')->group(function () {
    Route::post('/debtors_add_do', [DebtorsController::class, "debtors_add_do"])->name('debtors_add_do');
    Route::get('/debtors_add', [DebtorsController::class, "debtors_add"])->name('debtors_add');
    Route::get('/debtors_chek', [DebtorsController::class, "debtors_chek"])->name('debtors_chek');
    Route::get('/debtors_chek_do', [DebtorsController::class, "debtors_chek_do"])->name('debtors_chek_do');
    Route::get('/debtors_dell/{id}', [DebtorsController::class, "debtors_dell"])->name('debtors_dell');
    Route::get('/debtors_dashboard', [DebtorsController::class, "debtors_dashboard"])->name('debtors_dashboard');
    Route::get('/debtors_dashboard_get', [DebtorsController::class, "debtors_dashboard_get"])->name('debtors_dashboard_get');
});
