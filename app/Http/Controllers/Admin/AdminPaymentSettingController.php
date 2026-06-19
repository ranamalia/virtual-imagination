<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPaymentSettingController extends Controller
{
    /**
     * Tampilkan form pengaturan rekening pembayaran.
     */
    public function index(): View
    {
        $setting = PaymentSetting::first() ?? new PaymentSetting();
        return view('admin.payment-settings.index', compact('setting'));
    }

    /**
     * Simpan / update pengaturan rekening.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bank'       => 'required|string|max:100',
            'nomor_rekening'  => 'required|string|max:50',
            'nama_pemilik'    => 'required|string|max:255',
            'whatsapp_number' => ['required', 'regex:/^\d{10,15}$/'],
        ], [
            'nama_bank.required'       => 'Nama bank wajib diisi.',
            'nomor_rekening.required'  => 'Nomor rekening wajib diisi.',
            'nama_pemilik.required'    => 'Nama pemilik rekening wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp admin wajib diisi.',
            'whatsapp_number.regex'    => 'Nomor WhatsApp harus berupa angka 10-15 digit (contoh: 628xx).',
        ]);

        $setting = PaymentSetting::first();

        if ($setting) {
            $setting->update($validated);
        } else {
            PaymentSetting::create($validated);
        }

        return back()->with('success', 'Pengaturan rekening pembayaran berhasil disimpan.');
    }
}
