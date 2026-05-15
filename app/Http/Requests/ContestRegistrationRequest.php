<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContestRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'university_id' => [
                'required',
                'string',
                'max:60',
                'regex:/^[A-Za-z0-9\/-]+$/',
                Rule::unique('contest_registrations', 'university_id'),
            ],
            'email' => [
                'required',
                'email',
                'max:190',
                Rule::unique('contest_registrations', 'email'),
            ],
            'platform_handle' => ['nullable', 'string', 'max:80', 'regex:/^[A-Za-z0-9_.-]+$/'],
            'preferred_language' => [
                'required',
                Rule::in([
                    'C++17',
                    'Python 3.12',
                    'Java 21',
                    'Kotlin 1.9',
                    'Rust 1.78',
                    'Go 1.22',
                ]),
            ],
            // Honeypot field should stay empty; bots typically fill hidden inputs.
            'website' => ['nullable', 'string', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'university_id.regex' => 'University ID may only contain letters, numbers, "/", or "-".',
            'platform_handle.regex' => 'Platform handle may only contain letters, numbers, dots, dashes, and underscores.',
            'university_id.unique' => 'This University ID is already registered.',
            'email.unique' => 'This email is already registered.',
        ];
    }
}
