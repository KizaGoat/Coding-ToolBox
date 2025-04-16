<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            // First name is required
            'first_name' => ['required', 'string', 'max:255'],
            // last name is required
            'last_name'  => ['required', 'string', 'max:255'],
            // password is required
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            // phone is required
            'phone' => ['nullable', 'string', 'max:20'],
            // avatar is required
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
