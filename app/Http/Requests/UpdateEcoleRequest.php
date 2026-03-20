<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEcoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        $ecole = $this->route('ecole');

        return $ecole && ($this->user()?->can('update', $ecole) ?? false);
    }

    public function rules(): array
    {
        return [
            'nom' => ['sometimes', 'required', 'string', 'min:2', 'max:120'],
            'ville' => ['sometimes', 'required', 'string', 'min:2', 'max:80'],
            'type' => ['sometimes', 'required', 'string', Rule::in(['Grande école', 'Université', 'Institut', 'Autre'])],
            'domaines' => ['sometimes', 'required', 'array', 'min:1'],
            'domaines.*' => ['required_with:domaines', 'string', 'min:2', 'max:80'],
            'filieres' => ['sometimes', 'required', 'array', 'min:1'],
            'filieres.*' => ['required_with:filieres', 'string', 'min:2', 'max:120'],
            'logo_url' => ['nullable', 'url', 'max:2048'],
        ];
    }
}
