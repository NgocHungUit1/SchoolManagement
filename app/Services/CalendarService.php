<?php

/**
 *  CalendarService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\ClassTeacher;
use App\Models\ExamSchedule;
use App\Models\Week;
use Illuminate\Support\Facades\Auth;

/**
 * CalendarService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */

class CalendarService
{
    /**
     * Get Exam time table student.
     *
     * @param int $class_id The ID of the class_id
     *
     * @return \Illuminate\View\View
     */
    public function getExamTimeTable($class_id)
    {
        $getExam = ExamSchedule::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimeTable = ExamSchedule::getExamTimeTable(
                $value->exam_id,
                $class_id
            );
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

    /**
     * Get time table student.
     *
     * @param int $class_id The ID of the class_id
     *
     * @return \Illuminate\View\View
     */
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
                $ClassSubject = ClassSubjectTimeTable::getRecord(
                    $value->class_id,
                    $value->subject_id,
                    $valueDay->id
                );
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
}
