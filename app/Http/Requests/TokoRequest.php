<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokoRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_toko' => 'required',
            'nama_pemilik_toko' => 'required',
            'nomor_kios' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_toko.required' => 'Nama toko harus diisi.',
            'nama_pemilik_toko.required' => 'Nama pemilik toko harus diisi.',
            'nomor_kios.required' => 'Nomor kios harus diisi.',
        ];
    }
}
