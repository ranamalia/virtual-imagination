<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// ── Public ────────────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ── User Dashboard ─────────────────────────────────────────────────────────────
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ── Booking Routes (PROTECTED: auth + role:user) ──────────────────────────────
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/bookings/create',    [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings',          [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// Riwayat Booking — cukup auth (bukan role:user agar fleksibel)
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
});

// ── Profile (harus login) ─────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ── Admin Routes (PROTECTED: auth + role:admin) ────────────────────────────────
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Booking
        Route::get('/bookings',                    [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}',          [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::delete('/bookings/{booking}',       [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

        // Manajemen User
        Route::get('/users',               [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}',        [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit',   [AdminUserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}',      [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}',     [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Manajemen Paket
        Route::get('/packages',                 [AdminPackageController::class, 'index'])->name('packages.index');
        Route::get('/packages/create',          [AdminPackageController::class, 'create'])->name('packages.create');
        Route::post('/packages',                [AdminPackageController::class, 'store'])->name('packages.store');
        Route::get('/packages/{package}/edit',  [AdminPackageController::class, 'edit'])->name('packages.edit');
        Route::patch('/packages/{package}',     [AdminPackageController::class, 'update'])->name('packages.update');
        Route::delete('/packages/{package}',    [AdminPackageController::class, 'destroy'])->name('packages.destroy');
    });

// ── Auth ──────────────────────────────────────────────────────────────────────
require __DIR__ . '/auth.php';