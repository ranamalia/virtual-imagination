<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

// ── Public Landing ─────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Named aliases for landing-page sections (same controller, client-side scroll via anchor)
Route::get('/studiorent', [HomeController::class, 'index'])->name('studiorent');
Route::get('/portfolio',  [HomeController::class, 'index'])->name('portfolio');
Route::get('/contact',    [HomeController::class, 'index'])->name('contact');

// ── Permanent redirects: old /dashboard routes → / ───────────────────────────
Route::redirect('/dashboard',           '/', 301);
Route::redirect('/dashboard/studiorent','/', 301);

// ── Booking Routes (PROTECTED: auth required) ─────────────────────────────────
Route::middleware(['auth'])->group(function () {
    // Riwayat booking milik user
    Route::get('/bookings',            [BookingController::class, 'index'])->name('bookings.index');
    // Form buat booking baru
    Route::get('/bookings/create',     [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings',           [BookingController::class, 'store'])->name('bookings.store');
    // Detail / konfirmasi setelah booking
    Route::get('/bookings/{booking}',  [BookingController::class, 'show'])->name('bookings.show');
    // Redirect ke WhatsApp setelah booking berhasil
    Route::get('/bookings/{booking}/whatsapp', [BookingController::class, 'whatsapp'])->name('bookings.whatsapp');
});

// ── Profile (harus login) ─────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Testimoni
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
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

        // Manajemen Portfolio
        Route::get('/portfolios',                   [AdminPortfolioController::class, 'index'])->name('portfolios.index');
        Route::get('/portfolios/create',            [AdminPortfolioController::class, 'create'])->name('portfolios.create');
        Route::post('/portfolios',                  [AdminPortfolioController::class, 'store'])->name('portfolios.store');
        Route::get('/portfolios/{portfolio}/edit',  [AdminPortfolioController::class, 'edit'])->name('portfolios.edit');
        Route::patch('/portfolios/{portfolio}',     [AdminPortfolioController::class, 'update'])->name('portfolios.update');
        Route::delete('/portfolios/{portfolio}',    [AdminPortfolioController::class, 'destroy'])->name('portfolios.destroy');

        // Manajemen Testimoni
        Route::get('/testimonials',                            [AdminTestimonialController::class, 'index'])->name('testimonials.index');
        Route::patch('/testimonials/{testimonial}/toggle',     [AdminTestimonialController::class, 'toggleActive'])->name('testimonials.toggle');
        Route::delete('/testimonials/{testimonial}',           [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');
    });

// ── Auth ──────────────────────────────────────────────────────────────────────
require __DIR__ . '/auth.php';