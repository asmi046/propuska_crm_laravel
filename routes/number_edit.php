<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumberEditController;


Route::middleware('auth')->group(function () {
    Route::get('/edit_number_info/{id}', [NumberEditController::class, "index"])->name('edit_number_info');
    Route::post('/save_number_info', [NumberEditController::class, "save_number_info"])->name('save_number_info');
    Route::get('/create', [NumberEditController::class, "create"])->name('create');
    Route::post('/create_number_info', [NumberEditController::class, "create_number_info"])->name('create_number_info');
    Route::post('/delete_number', [NumberEditController::class, "delete_number"])->name('delete_number');

    Route::get('/add_many_numbers', [NumberEditController::class, "add_many_numbers"])->name('add_many_numbers');
    Route::post('/create_many_numbers', [NumberEditController::class, "create_many_numbers"])->name('create_many_numbers');
});
