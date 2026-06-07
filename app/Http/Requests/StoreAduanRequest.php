<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAduanRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:1000',
            'no_hp' => 'required|string|max:20',
            'pesan' => 'required|string',
            'ktp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'bukti_dukung' => 'nullable|file|mimes:jpeg,png,jpg,pdf,zip,rar,doc,docx,xls,xlsx|max:10240',
        ];
    }
}
