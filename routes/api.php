<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('airports', [\App\Http\Controllers\API\AirportController::class, 'index']);
Route::post('flight/import', [\App\Http\Controllers\API\FlightController::class, 'import']);
