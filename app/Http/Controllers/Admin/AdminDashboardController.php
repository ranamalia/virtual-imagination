<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Package;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan data DINAMIS dari database.
     */
    public function index()
    {
        // ── Statistik ─────────────────────────────────────────────────────────
        $totalBookings     = Booking::count();
        $pendingBookings   = Booking::where('status', Booking::STATUS_MENUNGGU_KONFIRMASI)->count();
        $verifyBookings    = Booking::where('status', Booking::STATUS_MENUNGGU_VERIFIKASI)->count();
        $confirmedBookings = Booking::where('status', Booking::STATUS_TERKONFIRMASI)->count();
        $totalUsers        = User::where('role', 'user')->count();
        $totalPackages     = Package::where('is_active', true)->count();

        // ── 10 Booking Terbaru (eager load user + package) ────────────────────
        $recentBookings = Booking::with(['user', 'package'])
            ->latest()
            ->take(10)
            ->get();

        // ── Booking yang perlu tindakan admin segera ──────────────────────────
        $pendingList = Booking::with(['user', 'package'])
            ->whereIn('status', [
                Booking::STATUS_MENUNGGU_KONFIRMASI,
                Booking::STATUS_MENUNGGU_VERIFIKASI,
            ])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'verifyBookings',
            'confirmedBookings',
            'totalUsers',
            'totalPackages',
            'recentBookings',
            'pendingList'
        ));
    }
}
