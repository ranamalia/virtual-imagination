<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminTestimonialController extends Controller
{
    /**
     * Daftar semua testimoni (dengan relasi user).
     */
    public function index(): View
    {
        $testimonials = Testimonial::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Toggle status aktif/nonaktif testimoni.
     */
    public function toggleActive(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_active' => ! $testimonial->is_active]);

        $status = $testimonial->is_active ? 'diaktifkan' : 'disembunyikan';

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', "Testimoni berhasil {$status}.");
    }

    /**
     * Hapus testimoni.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}
