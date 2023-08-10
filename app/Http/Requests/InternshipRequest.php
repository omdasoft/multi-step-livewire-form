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
            'state.internship_certified' => ['required'],
            'state.internship_training' => 'required',            
            'state.country_id' => 'required|exists:countries,id',            
            'state.hospital_name' => 'required|string|min:2|max:255',            
            'state.sector' => 'required',
            'state.duration' => 'required|int',
            'state.start_date' => 'required|date',
            'state.end_date' => 'required|date',  
        ];
    }
}
