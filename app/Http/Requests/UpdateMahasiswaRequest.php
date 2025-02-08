<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMahasiswaRequest extends FormRequest
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
            'nrp' => [
                'required',
                'string',
                'max:10',
                Rule::unique('mahasiswas', 'nrp')->ignore($this->model)
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }
}
