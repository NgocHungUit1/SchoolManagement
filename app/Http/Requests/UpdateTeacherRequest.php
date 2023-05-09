<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'mobile_number' => 'required',
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'joining_date' => 'required',
            'password' => 'required',
            'qualification' => 'required',
            'experience' => 'required',
        ];
    }
}
