<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UploadPaymentProofRequest;
use App\Models\Booking;
use App\Models\Package;
use App\Models\PaymentSetting;
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
     * Simpan booking baru, lalu redirect ke halaman konfirmasi + WhatsApp.
     */
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $package = Package::findOrFail($request->package_id);

        $booking = Booking::create([
            'user_id'         => Auth::id(),
            'package_id'      => $package->id,
            'full_name'       => $request->full_name,
            'email'           => $request->email,
            'whatsapp'        => $request->whatsapp,
            'service'         => $package->name,
            'booking_date'    => $request->booking_date,
            'booking_time'    => $request->booking_time,
            'special_request' => $request->special_request,
            'price'           => $package->price,
            'status'          => Booking::STATUS_MENUNGGU_KONFIRMASI,
        ]);

        return redirect()->route('bookings.whatsapp', $booking->id);
    }

    /**
     * Tampilkan halaman konfirmasi + buka WhatsApp admin.
     */
    public function whatsapp(Booking $booking): mixed
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        $booking->load('package');

        $setting = PaymentSetting::getCurrent();

        $nama   = $booking->full_name;
        $tgl    = \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y');
        $jam    = \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H.i');
        $paket  = $booking->package->name ?? $booking->service;

        $pesan = "Halo Admin Photo Studio,\n\n"
               . "Saya ingin melakukan booking.\n\n"
               . "Nama: {$nama}\n"
               . "Paket: {$paket}\n"
               . "Tanggal: {$tgl}\n"
               . "Jam: {$jam}\n\n"
               . "Mohon konfirmasi ketersediaan jadwal. Terima kasih.";

        $waNumber = $setting->whatsapp_number;
        $waUrl    = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($pesan);

        return view('bookings.confirmation', compact('booking', 'waUrl'));
    }

    /**
     * Detail booking — tampilan dinamis sesuai status.
     */
    public function show(Booking $booking): View
    {
        abort_if($booking->user_id !== Auth::id(), 403, 'Anda tidak memiliki akses ke booking ini.');
        $booking->load('package');

        $paymentSetting = null;
        if (in_array($booking->status, [
            Booking::STATUS_MENUNGGU_PEMBAYARAN,
            Booking::STATUS_PEMBAYARAN_DITOLAK,
        ])) {
            $paymentSetting = PaymentSetting::getCurrent();
        }

        return view('bookings.show', compact('booking', 'paymentSetting'));
    }

    /**
     * Upload bukti transfer pembayaran.
     */
    public function uploadProof(UploadPaymentProofRequest $request, Booking $booking): RedirectResponse
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        // Hanya boleh upload jika status menunggu_pembayaran atau pembayaran_ditolak
        abort_unless(in_array($booking->status, [
            Booking::STATUS_MENUNGGU_PEMBAYARAN,
            Booking::STATUS_PEMBAYARAN_DITOLAK,
        ]), 422, 'Status booking tidak memungkinkan upload bukti transfer.');

        // Simpan file
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $booking->update([
            'payment_proof' => $path,
            'status'        => Booking::STATUS_MENUNGGU_VERIFIKASI,
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Bukti transfer berhasil diunggah. Menunggu verifikasi admin.');
    }
}
