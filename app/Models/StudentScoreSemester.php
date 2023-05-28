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

    public static function getAcademicRecords()
    {
        return StudentScoreSemester::select('student_score_average.*', 'users.name as student_name', 'class.name as class_name')
            ->join('users', 'users.id', '=', 'student_score_average.student_id')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->get();
    }
}