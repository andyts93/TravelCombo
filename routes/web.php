<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('trip', \App\Http\Controllers\TripController::class);
Route::post('flight', [\App\Http\Controllers\FlightController::class, 'store'])->name('flight.store');
Route::put('flight', [\App\Http\Controllers\FlightController::class, 'update'])->name('flight.update');

Route::post('accomodation', [\App\Http\Controllers\AccomodationController::class, 'store'])->name('accomodation.store');

require __DIR__.'/auth.php';
