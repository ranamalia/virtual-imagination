<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(): View
    {
        $packages = Package::active()->get();
        return view('bookings.create', compact('packages'));
    }

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $package = Package::findOrFail($request->package_id);

        // Upload bukti pembayaran ke storage/app/public/payment_proofs
        $proofPath = $request->file('payment_proof')
            ->store('payment_proofs', 'public');

        $booking = Booking::create([
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
            'status'          => 'Pending',
        ]);

        return redirect()->route('bookings.show', $booking->id);
    }

    public function show(Booking $booking): View
    {
        $booking->load('package');
        return view('bookings.confirmation', compact('booking'));
    }
}
