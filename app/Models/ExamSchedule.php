<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;
    protected $table = 'exam_schedule';

    protected $fillable = [
        'exam_id',
        'class_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
        'room_number',
        'full_mark',
        'passing_mark',
        'created_by',
        'semester_id'
    ];

    public static function deleteRecord($exam_id, $class_id, $semester_id)
    {
        ExamSchedule::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('semester_id', '=', $semester_id)->delete();
    }

    public static function getRecordSignle($exam_id, $class_id, $subject_id, $semester_id)
    {
        return ExamSchedule::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->where('semester_id', '=', $semester_id)->first();
    }

    public static function getExamTimeTable($exam_id, $class_id, $semester_id)
    {
        return ExamSchedule::select('exam_schedule.*', 'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', '=', 'exam_schedule.subject_id')
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->where('exam_schedule.exam_id', '=', $exam_id)
            ->where('exam_schedule.class_id', '=', $class_id)
            ->where('exam_schedule.semester_id', '=', $semester_id)
            ->get();
    }

    public static function getExamTimeTableTeacher($exam_id, $class_id, $subject_id, $semester_id)
    {
        return ExamSchedule::select('exam_schedule.*', 'subject.name as subject_name', 'subject.type as subject_type')
            ->join('subject', 'subject.id', '=', 'exam_schedule.subject_id')
            ->where('exam_schedule.exam_id', '=', $exam_id)
            ->where('exam_schedule.class_id', '=', $class_id)
            ->where('exam_schedule.subject_id', '=', $subject_id)
            ->where('exam_schedule.semester_id', '=', $semester_id)
            ->get();
    }

    public static function getExam($class_id)
    {
        return ExamSchedule::select('exam_schedule.*', 'exam.name as exam_name', 'exam.description as percent')
            ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
            ->where('exam_schedule.class_id', '=', $class_id)
            ->groupBy('exam_schedule.exam_id')
            ->get();
    }


    public static function getExamSemester()
    {
        return ExamSchedule::select('exam_schedule.*')
            ->groupBy('exam_schedule.exam_id')
            ->get();
    }

    // public static function getExamScore($subject_id, $class_id)
    // {
    //     return ExamSchedule::select('exam_schedule.*', 'exam.name as exam_name')
    //         ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
    //         ->where('exam_schedule.subject_id', '=', $subject_id)
    //         ->where('exam_schedule.class_id', '=', $class_id)
    //         ->get();
    // }
    public static function getExamTeacher($class_id, $subject_id)
    {
        return ExamSchedule::select('exam_schedule.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
            ->where('exam_schedule.class_id', '=', $class_id)
            ->where('exam_schedule.subject_id', '=', $subject_id)
            ->groupBy('exam_schedule.exam_id')
            ->get();
    }
    public static function  getExamCalendarTeacher($teacher_id)
    {
        return ExamSchedule::select('exam_schedule.*', 'exam.name as exam_name', 'class.name as class_name', 'subject.name as subject_name')
            ->join('teacher_class', 'teacher_class.class_id', '=', 'exam_schedule.class_id')
            ->join('class', 'class.id', '=', 'teacher_class.class_id')
            ->join('subject', 'subject.id', '=', 'teacher_class.subject_id')
            ->join('exam', 'exam.id', '=', 'exam_schedule.exam_id')
            ->where('teacher_class.teacher_id', '=', $teacher_id)
            ->get();
    }
    public static function getScore($class_id, $student_id, $subject_id, $exam_id)
    {
        return ExamScore::CheckAlready($class_id, $student_id, $subject_id, $exam_id);
    }

    public static function getScoreSemester($class_id, $student_id, $subject_id, $exam_id, $semester_id)
    {
        return ExamScore::CheckAlreadySemester($class_id, $student_id, $subject_id, $exam_id, $semester_id);
    }
}
