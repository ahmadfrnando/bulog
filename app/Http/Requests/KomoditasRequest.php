<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KomoditasRequest extends FormRequest
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
         $routeParam = $this->route('petuga');
        $id = is_object($routeParam) ? $routeParam->id : $routeParam;
        return [
            'code' => 'required|unique:komoditas,code',
            'code' => [
                'required',
                Rule::unique('komoditas', 'code')->ignore($id), // ganti 'users' & kolom kalau berbeda
            ],
            'nama' => 'required',
            'unit' => 'required',
            'kategori' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Kode Komoditas harus diisi.',
            'code.unique' => 'Kode Komoditas sudah digunakan.',
            'nama.required' => 'Nama Komoditas harus diisi.',
            'unit.required' => 'Unit Komoditas harus diisi.',
        ];
    }
}
