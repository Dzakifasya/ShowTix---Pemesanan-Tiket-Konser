<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
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
            'nama_lengkap' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'email_confirmation' => ['required', 'email', 'same:email'],
            'no_whatsapp' => ['required', 'string', 'min:9', 'max:15'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan,other'],
            'provinsi' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:' . now()->subYears(5)->format('Y-m-d')],
            'agree_terms' => ['required', 'accepted'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.min' => 'Nama minimal 3 karakter',
            'nama_lengkap.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email_confirmation.required' => 'Konfirmasi email wajib diisi',
            'email_confirmation.same' => 'Email tidak cocok',
            'no_whatsapp.required' => 'Nomor WhatsApp wajib diisi',
            'no_whatsapp.min' => 'Nomor WhatsApp minimal 9 digit',
            'no_whatsapp.max' => 'Nomor WhatsApp maksimal 15 digit',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
            'provinsi.required' => 'Provinsi wajib dipilih',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal tidak valid',
            'tanggal_lahir.before_or_equal' => 'Anda harus minimal 5 tahun',
            'agree_terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
            'agree_terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'agree_terms' => $this->input('agree_terms') === 'on' ? true : false,
        ]);
    }
}
