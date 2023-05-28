<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassSubject extends Model
{
    use HasFactory;
    protected $table = 'class_subject';
    protected $fillable = [
        'class_id',
        'subject_id',
        'status',
        'is_delete',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    public static function getRecord()
    {
        $return = self::select('class_subject.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')->join('subject', 'subject.id', '=', 'class_subject.subject_id')->join('class', 'class.id', '=', 'class_subject.class_id')->join('users', 'users.id', '=', 'class_subject.created_by')->where('class_subject.is_delete', '=', 0);

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . Request::get('subject_name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('class_subject.id', 'desc')->get();
        return $return;
    }
    public static function getAlreadyFirst($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }
    public static function deleteSubject($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }
    public static function getAssignSubjectId($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    public static function MySubject($class_id)
    {
        return self::select('class_subject.*', 'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
            ->join('class', 'class.id', '=', 'class_subject.class_id')
            ->join('users', 'users.id', '=', 'class_subject.created_by')
            ->where('class_subject.class_id', '=', $class_id)
            ->where('class_subject.is_delete', '=', 0)
            ->where('class_subject.status', '=', 0)
            ->orderBy('class_subject.id', 'desc')
            ->get();
    }




    public static function getMySubjectTeacher($class_id)
    {
        return ClassTeacher::select(
            'teacher_class.*',
            'class.name as class_name',
            'subject.name as subject_name',
            'subject.type as subject_type',
            'teacher.name as teacher_name'
        )
            ->join('users as teacher', 'teacher.id', '=', 'teacher_class.teacher_id')
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('teacher_class.class_id', '=', $class_id)
            ->get();
    }
}
