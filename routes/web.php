<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ── Booking / Reservation ─────────────────────────────────────────────────
Route::get('/bookings/create',      [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings',            [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}',   [BookingController::class, 'show'])->name('bookings.show');

// ── Auth / Profile ────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
