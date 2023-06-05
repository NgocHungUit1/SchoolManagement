<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentScoreSemester extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'student_score_average';
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'avage_score',
        'semester_id',
        'average_score_year',
        'rank'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng User với khóa ngoại là teacher_id
    }


    public static function getAcademicRecords($semester_id, $student_id)
    {
        return self::where('semester_id', $semester_id)
            ->whereIn('student_id', $student_id)
            ->get();
    }

    public static function getAcademicRecordStudent($student_id, $semester_id)
    {
        return self::where('student_id', $student_id)
            ->where('semester_id', $semester_id)
            ->get();
    }

    public static function deleteScore($student_id, $semester_id)
    {
        return self::whereIn('student_id', $student_id)
            ->where('semester_id', $semester_id)
            ->delete();
    }

    public static function deleteScores($student_id, $semester_id)
    {
        return self::whereIn('student_id', $student_id)
            ->where('semester_id', $semester_id)
            ->delete();
    }


    public static function getSemester1Average($studentId)
    {
        return self::where('student_id', $studentId)
            ->where('semester_id', 1)
            ->value('avage_score');
    }

    public static function getSemester2Average($studentId)
    {
        return self::where('student_id', $studentId)
            ->where('semester_id', 2)
            ->value('avage_score');
    }

    public static function getAverageScoreBySemester($studentId, $semesterId)
    {
        return self::where('student_id', $studentId)
            ->where('semester_id', $semesterId)
            ->value('avage_score');
    }
}
