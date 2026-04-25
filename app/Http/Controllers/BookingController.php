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
     * Form buat booking baru — jika tamu, redirect ke login.
     */
    public function create(): View
    {
        $packages = Package::active()->get();
        return view('bookings.create', compact('packages'));
    }

    /**
     * Simpan booking baru, lalu redirect ke WhatsApp untuk konfirmasi.
     */
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $package = Package::findOrFail($request->package_id);

        $booking = Booking::create([
            'user_id'         => Auth::id(),
            'package_id'      => $package->id,
            'full_name'       => $request->full_name,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'service'         => $package->name,
            'booking_date'    => $request->booking_date,
            'booking_time'    => $request->booking_time,
            'special_request' => $request->special_request,
            'payment_method'  => 'whatsapp',
            'price'           => $package->price,
            'status'          => 'pending',
        ]);

        // Redirect ke method whatsapp agar WhatsApp terbuka, lalu user diarahkan ke history
        return redirect()->route('bookings.whatsapp', $booking->id);
    }

    /**
     * Redirect ke WhatsApp API dengan pesan otomatis, lalu tampilkan halaman konfirmasi.
     */
    public function whatsapp(Booking $booking): mixed
    {
        // Pastikan booking ini milik user yang sedang login
        abort_if($booking->user_id !== Auth::id(), 403);

        $booking->load('package');

        $nama   = $booking->full_name;
        $tgl    = \Carbon\Carbon::parse($booking->booking_date)->format('d M Y');
        $waktu  = \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i');
        $paket  = $booking->package->name ?? $booking->service;
        $ref    = $booking->booking_reference;

        $pesan = "Halo Virtual Imagination, Saya sudah melakukan booking via website.\n"
               . "Nama: {$nama}\n"
               . "Tanggal: {$tgl} pukul {$waktu}\n"
               . "Paket: {$paket}\n"
               . "No. Referensi: {$ref}\n"
               . "Mohon konfirmasi ketersediaannya. Terima kasih!";

        $waNumber = '6281514191380'; // ganti dengan nomor WA studio
        $waUrl    = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($pesan);

        // Tampilkan halaman konfirmasi dengan link WhatsApp
        return view('bookings.confirmation', compact('booking', 'waUrl'));
    }

    /**
     * Detail booking — user hanya bisa lihat punyanya sendiri.
     */
    public function show(Booking $booking): View
    {
        abort_if($booking->user_id !== Auth::id(), 403, 'Anda tidak memiliki akses ke booking ini.');
        $booking->load('package');
        return view('bookings.confirmation', compact('booking'));
    }
}
