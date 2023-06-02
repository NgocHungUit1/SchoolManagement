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

    public function classSubjects()
    {
        return $this->hasMany(ClassSubjectTimeTable::class, 'subject_id', 'subject_id')
            ->where('class_id', $this->class_id)
            ->where('semester_id', $this->semester_id);
    }

    public function classSubjectTimetables()
    {
        return $this->hasOne(ClassSubjectTimetable::class, 'subject_id', 'subject_id')->where('semester_id', '=', $this->semester_id);
    }

    public function dayOfWeekInfo()
    {
        return $this->belongsTo(Week::class, 'day_id', 'id');
    }

    public function teachers()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng User với khóa ngoại là teacher_id
    }

    public function classes()
    {
        return $this->belongsTo(ClassModel::class, 'class_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng Class (Laravel sẽ tự đoán khóa ngoại là class_id)
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id'); // Mối quan hệ 1-nhiều (Belongs To) với bảng Subject (Laravel sẽ tự đoán khóa ngoại là subject_id)
    }


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by'); // Mối quan hệ 1-nhiều (Belongs To) với bảng User với khóa ngoại là created_by
    }

    public static function getRecord(array $params = [])
    {
        $return = self::with(['teachers', 'subjects', 'classes', 'createdBy'])
            ->where('teacher_class.is_delete', '=', 0);

        if (!empty($params['class_name'])) {
            $return = $return->whereHas('classes', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['class_name'] . '%');
            });
        }
        if (!empty($params['subject_name'])) {
            $return = $return->whereHas('subjects', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['subject_name'] . '%');
            });
        }
        if (!empty($params['teacher_name'])) {
            $return = $return->whereHas('teachers', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['teacher_name'] . '%');
            });
        }

        $return = $return->orderBy('teacher_class.id', 'desc')->get();

        return $return;
    }


    public static function getMySubjectTeacher($class_id)
    {
        return self::with(['teachers', 'subjects'])
            ->whereHas('classes', function ($query) use ($class_id) {
                $query->where([
                    ['id', $class_id],
                ]);
            })->where('is_delete', 0)
            ->where('status', 0)
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getAlreadyFirst($class_id, $teacher_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('teacher_id', '=', $teacher_id)->where('subject_id', '=', $subject_id)->first();
    }

    public static function getAlreadyTeacher($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->where('teacher_class.is_delete', '=', 0)->first();
    }

    public static function deleteSubject($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->delete();
    }

    public static function getMyClassSubject($teacher_id)
    {
        return ClassTeacher::with(['teachers', 'classes', 'subjects'])
            ->where('is_delete', '=', 0)
            ->where('status', '=', 0)
            ->whereHas('subjects', function ($query) {
                $query->where('is_delete', '=', 0)
                    ->where('status', '=', 0);
            })
            ->whereHas('classes', function ($query) {
                $query->where('is_delete', '=', 0)
                    ->where('status', '=', 0);
            })
            ->where('teacher_id', '=', $teacher_id)
            ->get();
    }

    public static function getSubjectExam($class_id, $teacher_id)
    {
        return ClassTeacher::with(['classes', 'subjects'])
            ->where('is_delete', '=', 0)
            ->where('status', '=', 0)
            ->whereHas('subjects', function ($query) {
                $query->where('is_delete', '=', 0)
                    ->where('status', '=', 0);
            })
            ->whereHas('classes', function ($query) {
                $query->where('is_delete', '=', 0)
                    ->where('status', '=', 0);
            })
            ->where('class_id', '=', $class_id)
            ->where('teacher_id', '=', $teacher_id)
            ->get();
    }



    public static function getMyClassTeacher($teacher_id)
    {
        return ClassTeacher::with(['classes', 'subjects'])
            ->where('is_delete', '=', 0)
            ->where('status', '=', 0)
            ->whereHas('subjects', function ($query) {
                $query->where('is_delete', '=', 0)
                    ->where('status', '=', 0);
            })
            ->whereHas('classes', function ($query) {
                $query->where('is_delete', '=', 0)
                    ->where('status', '=', 0);
            })
            ->where('teacher_id', '=', $teacher_id)
            ->groupBy('class_id')
            ->get();
    }

    public static function getCalendarTeacher($teacher_id, $semester_id)
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
            ->where('class_subject_timetable.semester_id', '=', $semester_id)
            ->where('teacher_class.is_delete', '=', 0)
            ->where('teacher_class.status', '=', 0)
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }

    public static function getAssignedSubjects($teacher_id, $class_id)
    {
        return self::where('teacher_id', $teacher_id)
            ->where('class_id', $class_id)
            ->pluck('subject_id')
            ->toArray();
    }
}
