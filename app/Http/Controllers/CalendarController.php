<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\ClassTeacher;
use App\Models\ExamSchedule;
use App\Models\Week;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

    public function myCalendar()
    {
        $data['getTimeTable'] = $this->getTimeTable(Auth::user()->class_id);
        $data['getExamTimeTable'] = $this->getExamTimeTable(Auth::user()->class_id);
        return view('student.my_calendar', $data)->with('success', 'My Time Table Student ');
    }

    //student
    public function getExamTimeTable($class_id)
    {
        $getExam = ExamSchedule::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimeTable = ExamSchedule::getExamTimeTable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimeTable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        return $result;

    }

    public function getTimeTable($class_id)
    {
        $result = array();
        $getRecord = ClassSubject::getMySubjectTeacher($class_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->subject_name;
            $dataS['teacher_name'] = $value->teacher_name;
            $getDay = Week::getRecord();
            $day = array();
            foreach ($getDay as $valueDay) {
                $dataDay = array();
                $dataDay['day_name'] = $valueDay->name;
                $dataDay['fullcalendar_day'] = $valueDay->fullcalendar_day;
                $ClassSubject = ClassSubjectTimeTable::getRecord($value->class_id, $value->subject_id, $valueDay->id);
                if (!empty($ClassSubject)) {
                    $dataDay['start_time'] = $ClassSubject->start_time;
                    $dataDay['end_time'] = $ClassSubject->end_time;
                    $dataDay['room_number'] = $ClassSubject->room_number;
                    $dataDay['start_date'] = $ClassSubject->start_date;
                    $dataDay['end_date'] = $ClassSubject->end_date;
                    $day[] = $dataDay;
                }
            }
            $dataS['day'] = $day;
            $result[] = $dataS;

        }
        return $result;
    }

    //teacher

    public function myTeacherCalendar()
    {
        $teacher_id = Auth::user()->id;
        $data['getCalendarTeacher'] = ClassTeacher::getCalendarTeacher($teacher_id);
        // dd($data);
        return view('teacher.my_calendar', $data)->with('success', 'My Time Table Teacher ');
    }

}
