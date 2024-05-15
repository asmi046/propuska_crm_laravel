<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumberEditController;


Route::middleware('auth')->group(function () {
    Route::get('/edit_number_info/{id}', [NumberEditController::class, "index"])->name('edit_number_info');
    Route::post('/save_number_info', [NumberEditController::class, "save_number_info"])->name('save_number_info');
    Route::get('/create', [NumberEditController::class, "create"])->name('create');
    Route::post('/create_number_info', [NumberEditController::class, "create_number_info"])->name('create_number_info');
    Route::get('/delete_number/{id}', [NumberEditController::class, "delete_number"])->name('delete_number');

    Route::get('/add_many_numbers', [NumberEditController::class, "add_many_numbers"])->name('add_many_numbers');
    Route::post('/add_many_numbers_line', [NumberEditController::class, "add_many_numbers_line"])->name('add_many_numbers_line');

    Route::get('/email_chenge', [NumberEditController::class, "email_chenge"])->name('email_chenge');
    Route::post('/email_chenge_do', [NumberEditController::class, "email_chenge_do"])->name('email_chenge_do');
});
