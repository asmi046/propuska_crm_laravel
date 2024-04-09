<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordReqController;

Route::middleware('guest')->group(function () {
    Route::get('/password-recovery', [PasswordReqController::class, "show_pass_req_form"])->name("passrec");
    Route::post('/pass_rec_do', [PasswordReqController::class, "pass_req_query"])->name("pass_rec_do");
    Route::get('/reset-password/{token}', [PasswordReqController::class, "pass_new_enter_form"])->name("password.reset");
    Route::post('/reset-password', [PasswordReqController::class, "pass_new_save"])->name('password.update');
});
