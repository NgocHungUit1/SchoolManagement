<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'admission_number' => 'required|unique:users',
            'name' => 'required',
            'mobile_number' => 'required',
            'class_id' => 'required',
            'roll_number' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'password' => 'required',
        ];

    }
}
