<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     */
    public function index()
    {
        $totalBookings  = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $totalUsers     = User::where('role', 'user')->count();

        // 5 booking terbaru
        $recentBookings = Booking::with('package')
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
