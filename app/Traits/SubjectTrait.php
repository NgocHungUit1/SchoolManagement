<?php
namespace App\Traits;

use App\Models\ClassSubject;

trait SubjectTrait
{
    public function get_Subject($class_id)
    {
        $getSubject = ClassSubject::MySubject($class_id);
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>" . $value->subject_name . " </option>";
        }
        $json['html'] = $html;

        return response()->json($json);
    }
}
