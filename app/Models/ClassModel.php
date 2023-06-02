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

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'is_delete',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function examScores()
    {
        return $this->hasMany(ExamScore::class, 'class_id');
    }

    public function teacherClasses()
    {
        return $this->hasMany(User::class, 'class_id', 'id')
            ->where('is_delete', '=', 0)
            ->where('user_type', '=', 2)
            ->where('status', '=', 0);
    }

    public function students()
    {
        return $this->hasMany(User::class, 'class_id')->where('user_type', 3)->where('is_delete', 0);
    }

    public function teachers()
    {
        return $this->hasMany(ClassTeacher::class, 'class_id', 'id');
    }





    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public static function getClass()
    {
        $return = ClassModel::with('createdBy')
            ->where('is_delete', 0)
            ->where('status', 0)
            ->orderBy('name', 'asc')
            ->get();
        return $return;
    }

    public static function getClassAcademic()
    {
        $return = ClassModel::with(['examScores' => function ($query) {
            $query->select('semester_id', 'class_id');
        }])
            ->where('is_delete', 0)
            ->where('status', 0)
            ->orderBy('name', 'asc')
            ->get();
        return $return;
    }

    public static function getRecord($name = '', $type = '', $date = '')
    {
        $query = self::with('createdBy')
            ->where('is_delete', 0);

        if (!empty($name)) {
            $query = $query->where('class.name', 'like', '%' . $name . '%');
        }

        if (!empty($type)) {
            $query = $query->where('class.type', 'like', '%' . $type . '%');
        }

        if (!empty($date)) {
            $query = $query->whereDate('class.created_at', '=', $date);
        }

        $query = $query->orderBy('class.id', 'desc')->get();
        return $query;
    }


    public static function getStudentTeacher($teacher_id)
    {
        $return = ClassModel::with(['students'])
            ->whereHas('teachers', function ($query) use ($teacher_id) {
                $query->where('teacher_id', $teacher_id)->where('status', 0);
            })
            ->orderBy('id', 'desc')
            ->get();
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
}
