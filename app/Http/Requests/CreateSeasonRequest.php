<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSeasonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'number' => ['nullable', 'integer'],
            'slug' => ['required', 'unique:seasons,slug'],
            'bio' => ['nullable', 'string'],
            'cover_art_url' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
