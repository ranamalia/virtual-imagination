<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminPackageController extends Controller
{
    /**
     * Daftar semua paket.
     */
    public function index(Request $request): View
    {
        $query = Package::withCount('bookings')->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $packages = $query->paginate(15)->withQueryString();

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Form create paket baru.
     */
    public function create(): View
    {
        return view('admin.packages.create');
    }

    /**
     * Simpan paket baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255', 'unique:packages,name'],
            'description'      => ['nullable', 'string'],
            'price'            => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'is_active'        => ['boolean'],
            'thumbnail'        => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['slug']      = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('packages', 'public');
        }

        Package::create($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', "Paket \"{$validated['name']}\" berhasil ditambahkan.");
    }

    /**
     * Form edit paket.
     */
    public function edit(Package $package): View
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update paket.
     */
    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255', "unique:packages,name,{$package->id}"],
            'description'      => ['nullable', 'string'],
            'price'            => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'is_active'        => ['boolean'],
            'thumbnail'        => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['slug']      = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', "Paket \"{$package->name}\" berhasil diperbarui.");
    }

    /**
     * Hapus paket.
     */
    public function destroy(Package $package): RedirectResponse
    {
        $name = $package->name;
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', "Paket \"{$name}\" berhasil dihapus.");
    }
}
