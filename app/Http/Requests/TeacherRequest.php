<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            // 'teacher_id' => 'required|unique:users',
            'subject_id' => 'required',
            'name' => 'required',
            'joining_date' => 'required',
            'qualification' => 'required',
            'experience' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'password' => 'required',
            'mobile_number' => 'required',

        ];
    }
}
