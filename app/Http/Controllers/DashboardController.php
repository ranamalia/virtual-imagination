<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Portfolio;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user       = Auth::user();
        $packages   = Package::active()->orderBy('price')->get();
        $portfolios = Portfolio::active()->ordered()->get();
        $bookings   = Booking::where('user_id', $user->id)
                             ->with('package')
                             ->latest()
                             ->take(5)
                             ->get();

        return view('dashboard', compact('user', 'packages', 'portfolios', 'bookings'));
    }
}
