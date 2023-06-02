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
        return $this->hasMany(User::class, 'id');
    }


    public function exam_score()
    {
        return $this->belongsTo(ExamScore::class, 'subject_id');
    }

    public static function getAcademicRecords($class_id, $semester_id, $student_id, $subject_id)
    {
        return StudentScore::with(['subjects', 'student'])
            ->where('class_id', $class_id)
            ->where('semester_id', $semester_id)
            ->whereIn('student_id', $student_id)
            ->whereIn('subject_id', $subject_id)
            ->get();
    }
}
