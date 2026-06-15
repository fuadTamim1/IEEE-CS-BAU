<?php

namespace App\Http\Requests\Bcpc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BcpcRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'team_name' => ['required', 'string', 'max:120'],
            'captain_name' => ['required', 'string', 'max:120'],
            'captain_university_id' => [
                'required',
                'string',
                'max:60',
                'regex:/^[A-Za-z0-9\/-]+$/',
                Rule::unique('contest_registrations', 'university_id'),
            ],
            'captain_email' => [
                'required',
                'email',
                'max:190',
                Rule::unique('contest_registrations', 'email'),
            ],
            'team_size' => [
                'required',
                'integer',
                Rule::in([2, 3]),
            ],
            'member_two_name' => ['required', 'string', 'max:120'],
            'member_three_name' => ['nullable', 'required_if:team_size,3', 'string', 'max:120'],
            'website' => ['nullable', 'string', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'captain_university_id.regex' => 'University ID may only contain letters, numbers, "/", or "-".',
            'captain_university_id.unique' => 'This captain University ID is already registered.',
            'captain_email.unique' => 'This captain email is already registered.',
            'member_three_name.required_if' => 'Member 3 name is required when team size is 3.',
        ];
    }
}
