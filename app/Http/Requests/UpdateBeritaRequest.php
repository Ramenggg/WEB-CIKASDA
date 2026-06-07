<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeritaRequest extends FormRequest
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
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'delete_images'   => 'nullable|array',
            'delete_images.*' => 'integer'
        ];
    }
}
