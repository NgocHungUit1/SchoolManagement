<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public static function getClassId($id)
    {
        return self::find($id);
    }
    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public static function getClass()
    {
        $return = ClassModel::select('class.*')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')->get();
        return $return;
    }

    public static function getStudent($id)
    {
        $return = User::select('users.*', 'users.name as student_name', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('class.id', '=', $id)
            ->orderBy('student_name', 'asc')->get();
        return $return;
    }

    public static function getRecord()
    {
        $return = ClassModel::select('class.*', 'users.name as created_by_name')->join('users', 'users.id', 'class.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('type'))) {
            $return = $return->where('class.type', 'like', '%' . Request::get('type') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class.created_at', '=', Request::get('date'));
        }

        $return = $return->where('class.is_delete', '=', 0)->orderBy('class.id', 'desc')->get();
        return $return;
    }
    public static function getTeacherClass($id)
    {
        $return = ClassModel::select('class.*', 'class.name as class_name')
            ->join('users', 'users.class_id', '=', 'class.id')
            ->where('users.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('users.id', '=', $id)
            ->orderBy('class_name', 'asc')->get();
        return $return;
    }

    public static function getStudentTeacher($teacher_id)
    {

        $return = ClassModel::select('class.*', 'class.name as class_name', 'users.name as created_by_name')
            ->join('users', 'users.class_id', '=', 'class.id')
            ->join('teacher_class', 'teacher_class.class_id', '=', 'class.id')
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->orderBy('class.id', 'desc')->groupBy('class.id')
            ->get();
        return $return;
    }

}
