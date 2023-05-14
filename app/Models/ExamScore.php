<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScore extends Model
{
    use HasFactory;
    protected $table = 'exam_score';
    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public static function CheckAlready($class_id, $student_id,$exam_id,$subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('subject_id', '=', $subject_id)->first();
    }

    public static function getRecordStudent($class_id,$student_id){
        return ExamScore::select('exam_score.*', 'subject.name as subject_name', 'exam.name as exam_name')
        ->leftJoin('exam', 'exam.id', '=', 'exam_score.exam_id')
        ->leftJoin('subject', 'subject.id', '=', 'exam_score.subject_id')
        ->where('exam_score.student_id', '=', $student_id)
        ->where('exam_score.class_id', '=', $class_id)
        ->get();
    }

}
