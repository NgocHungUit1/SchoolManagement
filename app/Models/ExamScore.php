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

    protected $fillable = [
        'exam_id',
        'subject_id',
        'class_id',
        'student_id',
        'score',
        'created_by',
        'semester_id'
    ];

    public function studentScore()
    {
        return $this->belongsTo(StudentScore::class, ['subject_id', 'class_id', 'student_id'], ['subject_id', 'class_id', 'student_id']);
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classes()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function exams()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    public static function CheckAlready($class_id, $student_id, $exam_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('subject_id', '=', $subject_id)->first();
    }

    public static function CheckAlreadySemester($class_id, $student_id, $exam_id, $subject_id, $semester_id)
    {
        return self::where('class_id', '=', $class_id)
            ->where('student_id', '=', $student_id)
            ->where('exam_id', '=', $exam_id)
            ->where('subject_id', '=', $subject_id)
            ->where('semester_id', '=', $semester_id)->first();
    }

    public static function getRecordStudent($class_id, $student_id, $semester_id)
    {
        return ExamScore::with(['exams', 'subjects'])
            ->where('student_id', $student_id)
            ->where('class_id', $class_id)
            ->where('semester_id', $semester_id)
            ->get();
    }
}
