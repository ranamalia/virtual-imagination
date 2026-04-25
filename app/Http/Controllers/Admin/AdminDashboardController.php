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
        $pendingBookings   = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $rejectedBookings  = Booking::where('status', 'rejected')->count();
        $totalUsers        = User::where('role', 'user')->count();
        $totalPackages     = Package::where('is_active', true)->count();

        // ── 10 Booking Terbaru (eager load user + package) ────────────────────
        $recentBookings = Booking::with(['user', 'package'])
            ->latest()
            ->take(10)
            ->get();

        // ── Booking Pending yang perlu tindakan segera ─────────────────────────
        $pendingList = Booking::with(['user', 'package'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'rejectedBookings',
            'totalUsers',
            'totalPackages',
            'recentBookings',
            'pendingList'
        ));
    }
}
