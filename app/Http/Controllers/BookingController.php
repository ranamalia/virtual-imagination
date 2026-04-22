<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Daftar semua booking milik user yang sedang login.
     */
    public function index(): View
    {
        $bookings = auth()->user()
            ->bookings()
            ->with('package')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Form buat booking baru.
     */
    public function create(): View
    {
        $packages = Package::active()->get();
        return view('bookings.create', compact('packages'));
    }

    /**
     * Simpan booking baru milik user yang sedang login.
     */
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $package = Package::findOrFail($request->package_id);

        $proofPath = $request->file('payment_proof')
            ->store('payment_proofs', 'public');

        $booking = Booking::create([
            'user_id'         => Auth::id(),                 // ← tie ke user login
            'package_id'      => $package->id,
            'full_name'       => $request->full_name,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'service'         => $package->name,
            'booking_date'    => $request->booking_date,
            'booking_time'    => $request->booking_time,
            'special_request' => $request->special_request,
            'payment_method'  => $request->payment_method,
            'price'           => $package->price,
            'payment_proof'   => $proofPath,
            'status'          => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking->id);
    }

    /**
     * Detail booking — user hanya bisa lihat punyanya sendiri.
     */
    public function show(Booking $booking): View
    {
        // Pastikan booking ini milik user yang sedang login
        abort_if($booking->user_id !== Auth::id(), 403, 'Anda tidak memiliki akses ke booking ini.');

        $booking->load('package');
        return view('bookings.confirmation', compact('booking'));
    }
}
