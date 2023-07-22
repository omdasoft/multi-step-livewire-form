<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'drProfile.name_ar' => ['required', 'string', 'max:255'],
            'drProfile.name_en' => ['required', 'string', 'max:255'],
            'drProfile.gender' => ['required'],
            'drProfile.bairthdate' => ['required', 'date'],
            'drProfile.nationality_id' => ['required', 'integer', 'exists:nationalities,id'],
            'drProfile.birthplace' => ['nullable', 'string', 'max:255'],
            'drProfile.phone' => ['required', 'string', 'max:20', 'unique:dr_profiles,phone'],
            'drProfile.phone_country_code' => ['nullable', 'string', 'max:5'],
            'drProfile.passport_no' => ['required','string', 'max:20'],
            'countryId' => ['required', 'integer', 'exists:countries,id'],
            'stateId' => ['required', 'integer', 'exists:states,id'],
            'cityId' => ['required', 'integer', 'exists:cities,id'],
            'drProfile.address' => ['nullable', 'string', 'max:255'],
        ];
    }
}
