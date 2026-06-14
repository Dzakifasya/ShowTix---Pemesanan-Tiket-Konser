<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'transaksi_id' => ['required', 'integer', 'exists:transaksis,id'],
            'metode_pembayaran' => [
                'required',
                'string',
                'in:bca_va,bni_va,bri_va,mandiri_va,permata_va,sinarmas_va,muamalat_va,qris'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'transaksi_id.required' => 'ID transaksi wajib diisi',
            'transaksi_id.integer' => 'ID transaksi tidak valid',
            'transaksi_id.exists' => 'Transaksi tidak ditemukan',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih',
            'metode_pembayaran.string' => 'Metode pembayaran tidak valid',
            'metode_pembayaran.in' => 'Metode pembayaran tidak tersedia',
        ];
    }
}
