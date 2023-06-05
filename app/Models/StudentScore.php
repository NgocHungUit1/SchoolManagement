<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    use HasFactory;
    protected $table = 'student_score';
    public $timestamps = false;
    protected $fillable = [
        'subject_id',
        'class_id',
        'student_id',
        'score',
        'avage_score',
        'semester_id'
    ];

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function exam_score()
    {
        return $this->belongsTo(ExamScore::class, 'subject_id');
    }

    public static function getAcademicRecords($semester_id, $student_id, $subject_id)
    {
        return StudentScore::with(['subjects', 'student'])
            ->where('semester_id', $semester_id)
            ->whereIn('student_id', $student_id)
            ->whereIn('subject_id', $subject_id)
            ->get();
    }

    public static function getAcademicRecordStudent($class_id, $semester_id)
    {
        return StudentScore::with(['subjects', 'student'])
            ->where('class_id', $class_id)
            ->where('semester_id', $semester_id)
            ->get();
    }

    public static function deleteScoreByClassSubjectSemester($class_id, $subject_id, $semester_id)
    {
        self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('semester_id', $semester_id)
            ->delete();
    }

    public static function getRecordStudent($class_id, $student_id, $semester_id)
    {
        return StudentScore::with(['subjects', 'student'])
            ->where('student_id', $student_id)
            ->where('class_id', $class_id)
            ->where('semester_id', $semester_id)
            ->get();
    }
}
