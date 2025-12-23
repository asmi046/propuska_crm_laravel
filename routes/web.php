<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::post('/stop_service', function(){
        $response = Http::get('https://ap.mosbot.ru/api/online_passes.json', [
            'apikey' => 'PZNLW4lgaUIxuocaGNV4qvKmFFMzVqd7',
            'truck_num' => 'Е153ТВ159'
        ]);

        return $response->json();

    })->name('stop_service');
});


