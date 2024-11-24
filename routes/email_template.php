<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailTemplateController;


Route::middleware('auth')->group(function () {
    Route::get('/email_template_list_get', [EmailTemplateController::class, "email_template_list_get"])->name('email_template_list_get');
    Route::post('/email_template_update', [EmailTemplateController::class, "email_template_update"])->name('email_template_update');
    Route::get('/email_template_list', [EmailTemplateController::class, "index"])->name('email_template_list');

});
