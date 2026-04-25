<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminPortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $query = Portfolio::latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $portfolios = $query->paginate(15)->withQueryString();
        $categories = Portfolio::categories();

        return view('admin.portfolios.index', compact('portfolios', 'categories'));
    }

    public function create(): View
    {
        $categories = Portfolio::categories();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'client'      => ['nullable', 'string', 'max:255'],
            'image'       => ['required', 'image', 'max:4096'],
            'is_featured' => ['boolean'],
            'is_active'   => ['boolean'],
            'sort_order'  => ['integer', 'min:0'],
        ]);

        $data['image']       = $request->file('image')->store('portfolios', 'public');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active', true);
        $data['sort_order']  = $request->input('sort_order', 0);

        Portfolio::create($data);

        return redirect()->route('admin.portfolios.index')
            ->with('success', "Portfolio \"{$data['title']}\" berhasil ditambahkan.");
    }

    public function edit(Portfolio $portfolio): View
    {
        $categories = Portfolio::categories();
        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'client'      => ['nullable', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'max:4096'],
            'is_featured' => ['boolean'],
            'is_active'   => ['boolean'],
            'sort_order'  => ['integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($portfolio->image);
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');
        $data['sort_order']  = $request->input('sort_order', 0);

        $portfolio->update($data);

        return redirect()->route('admin.portfolios.index')
            ->with('success', "Portfolio \"{$portfolio->title}\" berhasil diperbarui.");
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        Storage::disk('public')->delete($portfolio->image);
        $title = $portfolio->title;
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', "Portfolio \"{$title}\" berhasil dihapus.");
    }
}
