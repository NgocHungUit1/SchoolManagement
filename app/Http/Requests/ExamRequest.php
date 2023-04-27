<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'name' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'created_at' => 'required',
            'status' => 'required',
        ];

    }
}
