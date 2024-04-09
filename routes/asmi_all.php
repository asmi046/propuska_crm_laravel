<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\IndexController;

    Route::get('/test/{number}', [IndexController::class, "test"])->name('test');
