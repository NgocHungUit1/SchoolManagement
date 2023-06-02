<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimeTable extends Model
{
    use HasFactory;
    protected $table = 'class_subject_timetable';

    protected $fillable = [
        'day_id',
        'class_id',
        'subject_id',
        'start_time',
        'end_time',
        'room_number',
        'start_date',
        'end_date',
        'created_by',
        'semester_id'
    ];

    public function days()
    {
        return $this->belongsTo(Week::class, 'day_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public static function getRecord($classIds, $subjectIds, $dayIds, $semesterId)
    {
        return self::with(['subjects', 'classrooms', 'days'])
            ->where('class_id', $classIds)
            ->whereIn('subject_id', $subjectIds)
            ->whereIn('day_id', $dayIds)
            ->where('semester_id', $semesterId)
            ->groupBy('day_id')
            ->get();
    }

    public static function getTimeTable($semester_id, $class_id)
    {
        return self::with(['subjects', 'classrooms', 'days'])
            ->join('teacher_class', function ($join) use ($class_id) {
                $join->on('class_subject_timetable.subject_id', '=', 'teacher_class.subject_id')
                    ->where('teacher_class.class_id', '=', $class_id)
                    ->where('teacher_class.is_delete', '=', 0)
                    ->where('teacher_class.status', '=', 0);
            })
            ->where('class_subject_timetable.class_id', '=', $class_id)
            ->where('class_subject_timetable.semester_id', '=', $semester_id)
            ->get();
    }

    // public static function getRecord($classIds, $subjectIds, $dayIds, $semesterId)
    // {
    //     return self::whereIn('class_id', $classIds)
    //         ->whereIn('subject_id', $subjectIds)
    //         ->whereIn('day_id', $dayIds)
    //         ->where('semester_id', $semesterId)
    //         ->groupBy('day_id')
    //         ->get();
    // }


    public static function getDate($class_id, $subject_id, $semester_id)
    {
        return self::select('start_date', 'end_date')
            ->where('class_id', '=', $class_id)
            ->where('subject_id', '=', $subject_id)
            ->where('semester_id', '=', $semester_id)
            ->first();
    }
}
