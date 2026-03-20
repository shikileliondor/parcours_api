<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEcoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Models\Ecole::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'min:2', 'max:120'],
            'ville' => ['required', 'string', 'min:2', 'max:80'],
            'type' => ['required', 'string', Rule::in(['Grande école', 'Université', 'Institut', 'Autre'])],
            'domaines' => ['required', 'array', 'min:1'],
            'domaines.*' => ['required', 'string', 'min:2', 'max:80'],
            'filieres' => ['required', 'array', 'min:1'],
            'filieres.*' => ['required', 'string', 'min:2', 'max:120'],
            'logo_url' => ['nullable', 'url', 'max:2048'],
        ];
    }
}
