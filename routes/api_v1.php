<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\OutCheckController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->group(function () {
    Route::get('/get_number_info_out', [OutCheckController::class, "get_number_info_out"])->name('get_number_info_out');
    Route::get('/get_number_info_for_site', [OutCheckController::class, "get_number_info_for_site"])->name('get_number_info_for_site');
});
