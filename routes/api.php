<?php

use App\Http\Controllers\Api\BookingApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('bookings')->group(function () {
    Route::post('/', [BookingApiController::class, 'store'])->name('api.bookings.store');
    Route::get('/{booking}', [BookingApiController::class, 'show'])->name('api.bookings.show');
});