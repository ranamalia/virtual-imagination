<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'package_id'      => 'required|exists:packages,id',
            'full_name'       => 'required|string|max:255',
            'email'           => 'required|email',
            'phone'           => 'required|regex:/^\d{10,}$/',
            'booking_date'    => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'booking_time'    => 'required|date_format:H:i',
            'special_request' => 'nullable|string|max:1000',
            'payment_method'  => 'required|in:transfer,qris',
            'price'           => 'required|numeric|min:0',
            'payment_proof'   => 'required|file|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'package_id.required'       => 'Please select a service package.',
            'package_id.exists'         => 'The selected package does not exist.',
            'full_name.required'        => 'Full name is required.',
            'email.required'            => 'Email address is required.',
            'email.email'               => 'Please enter a valid email address.',
            'phone.required'            => 'Phone number is required.',
            'phone.regex'               => 'Phone number must be at least 10 digits.',
            'booking_date.required'     => 'Please select a preferred date.',
            'booking_date.after_or_equal' => 'Booking date must be today or a future date.',
            'booking_time.required'     => 'Please select a preferred time.',
            'payment_method.required'   => 'Please select a payment method.',
            'payment_method.in'         => 'Invalid payment method.',
            'price.required'            => 'Price is required.',
            'price.numeric'             => 'Price must be a valid number.',
            'payment_proof.required'    => 'Bukti pembayaran wajib diupload.',
            'payment_proof.image'       => 'File harus berupa gambar.',
            'payment_proof.mimes'       => 'Format file harus jpg, jpeg, png, atau webp.',
            'payment_proof.max'         => 'Ukuran file maksimal 5MB.',
        ];
    }
}
