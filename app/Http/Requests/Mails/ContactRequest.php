<?php

namespace App\Http\Requests\Mails;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;          // no auth check needed
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email'],
            'phone'      => ['nullable', 'string', 'max:20'],
            'message'    => ['required', 'string', 'max:1000'],
        ];
    }
}
