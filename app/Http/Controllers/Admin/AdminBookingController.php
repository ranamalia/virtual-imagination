<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PaymentSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    /**
     * Daftar semua booking dengan pagination + filter status.
     */
    public function index(Request $request): View
    {
        $query = Booking::with(['user', 'package'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('booking_reference', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(15)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Detail satu booking.
     */
    public function show(Booking $booking): View
    {
        $booking->load(['user', 'package']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Setujui jadwal booking (menunggu_konfirmasi → menunggu_pembayaran).
     */
    public function approve(Booking $booking): RedirectResponse
    {
        abort_unless($booking->status === Booking::STATUS_MENUNGGU_KONFIRMASI, 422,
            'Hanya booking dengan status "Menunggu Konfirmasi" yang dapat disetujui.');

        $booking->update(['status' => Booking::STATUS_MENUNGGU_PEMBAYARAN]);

        return back()->with('success', "Jadwal booking #{$booking->booking_reference} telah disetujui. User dapat melakukan pembayaran.");
    }

    /**
     * Tolak jadwal booking (menunggu_konfirmasi → ditolak).
     */
    public function reject(Booking $booking): RedirectResponse
    {
        abort_unless($booking->status === Booking::STATUS_MENUNGGU_KONFIRMASI, 422,
            'Hanya booking dengan status "Menunggu Konfirmasi" yang dapat ditolak.');

        $booking->update(['status' => Booking::STATUS_DITOLAK]);

        return back()->with('success', "Booking #{$booking->booking_reference} telah ditolak.");
    }

    /**
     * Verifikasi pembayaran (menunggu_verifikasi → terkonfirmasi).
     */
    public function verifyPayment(Booking $booking): RedirectResponse
    {
        abort_unless($booking->status === Booking::STATUS_MENUNGGU_VERIFIKASI, 422,
            'Hanya booking dengan status "Menunggu Verifikasi" yang dapat diverifikasi.');

        $booking->update(['status' => Booking::STATUS_TERKONFIRMASI]);

        return back()->with('success', "Pembayaran booking #{$booking->booking_reference} telah diverifikasi. Booking terkonfirmasi!");
    }

    /**
     * Tolak pembayaran (menunggu_verifikasi → pembayaran_ditolak).
     */
    public function rejectPayment(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless($booking->status === Booking::STATUS_MENUNGGU_VERIFIKASI, 422,
            'Hanya booking dengan status "Menunggu Verifikasi" yang dapat ditolak pembayarannya.');

        $booking->update([
            'status'        => Booking::STATUS_PEMBAYARAN_DITOLAK,
            'payment_proof' => null, // reset bukti agar user upload ulang
        ]);

        return back()->with('success', "Pembayaran booking #{$booking->booking_reference} ditolak. User diminta upload ulang bukti transfer.");
    }

    /**
     * Hapus booking.
     */
    public function destroy(Booking $booking): RedirectResponse
    {
        $ref = $booking->booking_reference;
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', "Booking #{$ref} berhasil dihapus.");
    }
}
