<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'prodi_id' => ['required', 'integer', 'exists:prodis,id'],
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'max:2999', 'min: 2000'],
        ];
    }
}
