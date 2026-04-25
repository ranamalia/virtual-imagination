<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Portfolio;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Public landing page — accessible without login.
     * Handles /, /studiorent, /portfolio, /contact
     * (section routes scroll to anchor via JS if needed).
     */
    public function index(Request $request)
    {
        $packages     = Package::active()->orderBy('price')->get();
        $portfolios   = Portfolio::active()->ordered()->get();
        $testimonials = Testimonial::active()->with('user')->latest()->get();

        // Detect section route name so view can auto-scroll
        $section = match ($request->route()->getName()) {
            'studiorent' => 'studio-rent',
            'portfolio'  => 'portfolio',
            'contact'    => 'contact',
            default      => null,
        };

        return view('welcome', compact('packages', 'portfolios', 'testimonials', 'section'));
    }
}
