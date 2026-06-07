<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'    => 'required|string|max:255',
            'konten'   => 'required|string',
            'kategori' => 'required|string',
            'status'   => 'required|string',
            'images'   => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072'
        ];
    }
}
