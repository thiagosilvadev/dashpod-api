<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEpisodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'season_id' => ['nullable', 'string', 'exists:seasons,id'],
            'cover_url' => ['nullable', 'string'],
            'audio_url' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
