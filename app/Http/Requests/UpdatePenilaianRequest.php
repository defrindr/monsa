<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenilaianRequest extends FormRequest
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
            'penilaian' => 'required|array',
            'penilaian.*.nilai_tugas' => 'required|numeric',
            'penilaian.*.nilai_uts' => 'required|numeric',
            'penilaian.*.nilai_uas' => 'required|numeric'
        ];
    }
}
