<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // hanya user yang login bisa booking
    }

    public function rules(): array
    {
        return [
            'package_id'      => 'required|exists:packages,id',
            'full_name'       => 'required|string|max:255',
            'email'           => 'required|email',
            'whatsapp'        => ['required', 'regex:/^\d{10,}$/'],
            'booking_date'    => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'booking_time'    => 'required|date_format:H:i',
            'special_request' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'package_id.required'         => 'Pilih paket studio terlebih dahulu.',
            'package_id.exists'           => 'Paket yang dipilih tidak tersedia.',
            'full_name.required'          => 'Nama lengkap wajib diisi.',
            'email.required'              => 'Alamat email wajib diisi.',
            'email.email'                 => 'Format email tidak valid.',
            'whatsapp.required'           => 'Nomor WhatsApp wajib diisi.',
            'whatsapp.regex'              => 'Nomor WhatsApp minimal 10 digit angka.',
            'booking_date.required'       => 'Pilih tanggal sesi.',
            'booking_date.after_or_equal' => 'Tanggal sesi tidak boleh di masa lalu.',
            'booking_time.required'       => 'Pilih jam mulai sesi.',
        ];
    }
}
