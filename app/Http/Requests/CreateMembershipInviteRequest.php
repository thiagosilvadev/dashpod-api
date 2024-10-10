<?php

namespace App\Http\Requests;

use App\Models\Enums\MembershipRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateMembershipInviteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'role' => ['required', new Enum(MembershipRole::class)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
