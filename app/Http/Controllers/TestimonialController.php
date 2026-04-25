<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    /**
     * Simpan testimoni baru dari user yang sedang login.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        Testimonial::create([
            'user_id'   => Auth::id(),
            'rating'    => $validated['rating'],
            'comment'   => $validated['comment'],
            'is_active' => true,
        ]);

        return redirect()
            ->to(route('home') . '#testimonials')
            ->with('testimonial_success', 'Terima kasih! Testimoni Anda berhasil dikirim.');
    }
}
