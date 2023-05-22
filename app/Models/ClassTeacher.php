<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassTeacher extends Model
{
    use HasFactory;
    protected $table = 'teacher_class';
    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'status',
        'is_delete',
        'created_by'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng User với khóa ngoại là teacher_id
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class,'class_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng Class (Laravel sẽ tự đoán khóa ngoại là class_id)
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng Subject (Laravel sẽ tự đoán khóa ngoại là subject_id)
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by'); // Mối quan hệ 1-nhiều (Belongs To) với bảng User với khóa ngoại là created_by
    }

    public static function getRecord()
    {
        return self::withRelations()
            ->className(Request::get('class_name'))
            ->subjectName(Request::get('subject_name'))
            ->teacherName(Request::get('teacher_name'))
            ->orderBy('teacher_class.id', 'desc')
            ->get();
    }

    public function scopeWithRelations($query)
    {
        return $query->select('teacher_class.*', 'class.name as class_name', 'subject.name as subject_name', 'teacher.name as teacher_name', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'teacher_class.teacher_id')
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->join('users', 'users.id', '=', 'teacher_class.created_by')
            ->where('teacher_class.is_delete', '=', 0);
    }

    public function scopeClassName($query, $className)
    {
        if (!empty($className)) {
            return $query->where('class.name', 'like', '%' . $className . '%');
        }
        return $query;
    }

    public function scopeSubjectName($query, $subjectName)
    {
        if (!empty($subjectName)) {
            return $query->where('subject.name', 'like', '%' . $subjectName . '%');
        }
        return $query;
    }

    public function scopeTeacherName($query, $teacherName)
    {
        if (!empty($teacherName)) {
            return $query->where('teacher.name', 'like', '%' . $teacherName . '%');
        }
        return $query;
    }

    public static function getAlreadyFirst($class_id, $teacher_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('teacher_id', '=', $teacher_id)->where('subject_id', '=', $subject_id)->first();
    }

    public static function getAlreadyTeacher($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->where('teacher_class.is_delete', '=', 0)->first();
    }

    // public static function getAssignTeacherId($class_id)
    // {
    //     return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    // }
    public static function deleteSubject($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->delete();
    }

    public static function getMyClassSubject($teacher_id)
    {
        return ClassTeacher::select(
            'teacher_class.*',
            'class.name as class_name',
            'subject.name as subject_name',
            'subject.type as subject_type',
            'class.id as class_id',
            'subject.id as subject_id'
        )
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }

    public static function getSubjectExam($class_id, $teacher_id)
    {
        return ClassTeacher::select(
            'teacher_class.*',
            'subject.name as subject_name',
            'subject.type as subject_type',
            'class.id as class_id',
            'subject.id as subject_id'
        )
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('teacher_class.class_id', '=', $class_id)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }


    public static function getMyClassTeacher($teacher_id)
    {
        return ClassTeacher::select(
            'teacher_class.*',
            'class.name as class_name',
            'class.id as class_id',
            'subject.id as subject_id'
        )
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->groupBy('teacher_class.class_id')
            ->get();
    }

    public static function getMyClassTeacherExamScore($class_id, $teacher_id)
    {
        return ClassTeacher::select(
            'teacher_class.*',
            'class.name as class_name',
            'subject.name as subject_name',
            'subject.type as subject_type',
            'class.id as class_id',
            'subject.id as subject_id'
        )
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->where('teacher_class.class_id', '=', $class_id)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }

    public static function getCalendarTeacher($teacher_id)
    {
        return ClassTeacher::select(
            'class_subject_timetable.*',
            'class.name as class_name',
            'subject.name as subject_name',
            'class.id as class_id',
            'day_of_week.name as day_name',
            'day_of_week.fullcalendar_day'
        )
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->join('class_subject_timetable', 'class_subject_timetable.subject_id', '=', 'subject.id')
            ->join('day_of_week', 'day_of_week.id', '=', 'class_subject_timetable.day_id')
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }
}
