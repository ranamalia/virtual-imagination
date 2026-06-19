<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPaymentProofRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'payment_proof' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120', // 5 MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_proof.required' => 'Bukti transfer wajib diunggah.',
            'payment_proof.file'     => 'File tidak valid.',
            'payment_proof.mimes'    => 'Format file harus JPG, PNG, atau PDF.',
            'payment_proof.max'      => 'Ukuran file maksimal 5 MB.',
        ];
    }
}
