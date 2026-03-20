<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:80'],
            'domain' => ['nullable', 'string', 'max:60'],
        ];
    }
}
