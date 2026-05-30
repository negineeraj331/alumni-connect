<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Name: only letters and spaces (no numbers, no symbols)
            'name'     => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            // Email: strictly a Gmail address
            'email'    => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/i'],
            // Password: min 8 chars, must contain at least one letter, one number, one special character
            'password' => ['required', 'string', 'confirmed', 'min:8',
                           'regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}$/'],
            'roles'    => 'required|array|min:1',
            'roles.*'  => 'exists:roles,name',

            // Conditional profile fields based on roles
            'graduation_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 4),
            'field_of_study'  => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex'     => 'Name may only contain letters and spaces — no numbers or special characters.',
            'email.regex'    => 'Only Gmail addresses are accepted (e.g. yourname@gmail.com).',
            'password.regex' => 'Password must be at least 8 characters and include letters, numbers, and a symbol.',
            'password.min'   => 'Password must be at least 8 characters.',
            'roles.required' => 'You must select at least one role.',
            'roles.*.exists' => 'Selected role is invalid.',
        ];
    }
}
