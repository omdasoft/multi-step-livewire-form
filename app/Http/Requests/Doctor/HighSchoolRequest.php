<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class HighSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'highSchool.country_id' => ['required', 'exists:countries,id'],
            'highSchool.study_field' => ['required', 'string', 'max:255'],
            'highSchool.year' => ['required', 'date'], 
        ];
    }
}
