<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailTemplateController;


Route::middleware('auth')->group(function () {
    Route::get('/email_template_list', [EmailTemplateController::class, "index"])->name('email_template_list');

});
