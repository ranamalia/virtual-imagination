<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan data DINAMIS dari database.
     */
    public function index()
    {
        // ── Statistik ─────────────────────────────────────────────────────────
        $totalBookings   = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalUsers      = User::where('role', 'user')->count();

        // ── 5 Booking Terbaru (eager load user + package) ─────────────────────
        $recentBookings = Booking::with(['user', 'package'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'totalUsers',
            'recentBookings'
        ));
    }
}
