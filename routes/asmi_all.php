<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\IndexController;

    Route::get('/dashboard', [IndexController::class, "index"])->name('home');
    Route::get('/test/{number}', [IndexController::class, "test"])->name('test');

    Route::get('/get_all_numbers', [IndexController::class, "get_all_numbers"])->name('get_all_numbers');

