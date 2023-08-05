<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternshipRequest extends FormRequest
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
            'internship.internship_certificate' => ['required'],
            'internship.internship_training' => 'required',            
            'internship.country_id' => 'required|exists:countries,id',            
            'internship.hospital_name' => 'required|string|min:2|max:255',            
            'internship.sector' => 'required',
            'internship.duration' => 'required|int|max:11',
            'internship.start_date' => 'required|date',
            'internship.end_date' => 'required|date',            
        ];
    }
}
