<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    use HasFactory;
    protected $table = 'teacher_class';
    public static function getRecord()
    {
        $return = self::select('teacher_class.*', 'class.name as class_name', 'teacher.name as teacher_name', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'teacher_class.teacher_id')
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('users', 'users.id', '=', 'teacher_class.created_by')
            ->where('teacher_class.is_delete', '=', 0);

        // if (!empty(Request::get('class_name'))) {
        //     $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        // }
        // if (!empty(Request::get('subject_name'))) {
        //     $return = $return->where('subject.name', 'like', '%' . Request::get('subject_name') . '%');
        // }
        // if (!empty(Request::get('date'))) {
        //     $return = $return->whereDate('created_at', '=', Request::get('date'));
        // }
        $return = $return->orderBy('teacher_class.id', 'desc')->get();
        return $return;
    }
    public static function getAlreadyFirst($class_id, $teacher_id)
    {
        return self::where('class_id', '=', $class_id)->where('teacher_id', '=', $teacher_id)->first();
    }
    public static function getAssignTeacherId($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }
    public static function deleteSubject($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }

    public static function getMyClassSubject($teacher_id)
    {
        return ClassTeacher::select('teacher_class.*', 'class.name as class_name', 'subject.name as subject_name', 'subject.type as subject_type',
            'class.id as class_id', 'subject.id as subject_id')
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('class_subject', 'class_subject.class_id', '=', 'class.id')
            ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }

    public static function getMyClassSubjectTeacher($teacher_id)
    {
        return ClassTeacher::select('teacher_class.*', 'class.name as class_name',
            'class.id as class_id')
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->groupBy('teacher_class.class_id')
            ->get();
    }

    public static function getCalendarTeacher($teacher_id)
    {
        return ClassTeacher::select('class_subject_timetable.*', 'class.name as class_name', 'subject.name as subject_name',
            'class.id as class_id', 'day_of_week.name as day_name', 'day_of_week.fullcalendar_day')
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('class_subject', 'class_subject.class_id', '=', 'class.id')
            ->join('class_subject_timetable', 'class_subject_timetable.subject_id', '=', 'class_subject.subject_id')
            ->join('subject', 'subject.id', '=', 'class_subject_timetable.subject_id')
            ->join('day_of_week', 'day_of_week.id', '=', 'class_subject_timetable.day_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }

}
