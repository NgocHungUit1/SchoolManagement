<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimeTable extends Model
{
    use HasFactory;
    protected $table = 'class_subject_timetable';

    public static function getRecord($class_id, $subject_id, $day_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->where('day_id', '=', $day_id)->first();
    }
}
