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
    ];

    public static function getRecord($class_id, $subject_id, $day_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->where('day_id', '=', $day_id)->first();
    }

    public static function getDate($class_id, $subject_id)
    {
        return self::select('start_date', 'end_date')
        ->where('class_id', '=', $class_id)
        ->where('subject_id', '=', $subject_id)
        ->first();
    }
}
