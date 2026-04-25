<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    /** Status yang diperbolehkan (enum: pending | confirmed | rejected) */
    private const ALLOWED_STATUSES = ['pending', 'confirmed', 'rejected'];

    /**
     * Daftar semua booking dengan pagination + filter status.
     */
    public function index(Request $request): View
    {
        $query = Booking::with(['user', 'package'])->latest();

        // Filter opsional berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter opsional berdasarkan search nama/email
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
     * Update status booking (pending / confirmed / rejected / scheduled).
     */
    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', self::ALLOWED_STATUSES)],
        ]);

        // ── Anti double-booking: cek konflik jika status diubah ke 'confirmed' ──
        if ($request->status === 'confirmed') {
            $conflict = Booking::where('id', '!=', $booking->id)
                ->where('status', 'confirmed')
                ->where('booking_date', $booking->booking_date)
                ->where('booking_time', $booking->booking_time)
                ->exists();

            if ($conflict) {
                return back()->withErrors(['status' =>
                    'Tidak dapat dikonfirmasi: sudah ada booking lain yang dikonfirmasi pada tanggal dan jam yang sama.'
                ]);
            }
        }

        $booking->update(['status' => $request->status]);

        return back()->with('success', "Status booking #{$booking->booking_reference} berhasil diubah menjadi «{$request->status}».");
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
