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
use Illuminate\Http\Request;
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
    public function getExamTimeTable($semester_id, $class_id)
    {
        $getExam = ExamSchedule::getExam($class_id);

        $getExamTimeTable = ExamSchedule::getExamTimeTable(
            $getExam->pluck('exam_id')->toArray(),
            $class_id,
            $semester_id
        );

        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;

            $resultS = array();
            foreach ($getExamTimeTable as $valueExam) {
                if ($valueExam->exam_id == $value->exam_id) {
                    $dataS = array();
                    $dataS['subject_name'] = $valueExam->subject_name;
                    $dataS['exam_date'] = $valueExam->exam_date;
                    $dataS['start_time'] = $valueExam->start_time;
                    $dataS['end_time'] = $valueExam->end_time;
                    $dataS['room_number'] = $valueExam->room_number;
                    $dataS['full_mark'] = $valueExam->full_mark;
                    $dataS['passing_mark'] = $valueExam->passing_mark;
                    $resultS[] = $dataS;
                }
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
    public function getTimeTable($semester_id, $class_id)
    {
        // Khởi tạo một mảng để chứa kết quả trả về
        $result = [];

        // Tải ClassTeacher, Subject và Teacher sử dụng eager loading
        $getRecord = ClassTeacher::getMySubjectTeacher($class_id);

        // Tải Week sử dụng lazy loading
        $getDay = Week::all();

        // Tải danh sách ClassSubjectTimeTable sử dụng eager loading
        $classSubjectList = ClassSubjectTimeTable::getRecord(
            $getRecord->pluck('class_id')->toArray(),
            $getRecord->pluck('subject_id')->toArray(),
            $getDay->pluck('id')->toArray(),
            $semester_id
        );


        // Duyệt qua từng bản ghi
        foreach ($getRecord as $value) {
            // Tạo một mảng để chứa thông tin về môn học và giáo viên
            $dataS = [];
            $dataS['name'] = $value->subject->name;
            $dataS['teacher_name'] = $value->teacher->name;

            // Tạo một mảng để chứa thông tin về các buổi học trong ngày
            $day = [];

            // Duyệt qua từng ngày trong tuần
            foreach ($getDay as $valueDay) {
                $dataDay = [];
                $dataDay['day_name'] = $valueDay->name;
                $dataDay['fullcalendar_day'] = $valueDay->fullcalendar_day;

                // Lấy danh sách ClassSubjectTimeTable cho ngày hiện tại
                $currentClassSubjects = $classSubjectList->where('class_id', $value->class_id)
                    ->where('subject_id', $value->subject_id)
                    ->where('day_id', $valueDay->id)
                    ->where('semester_id', $semester_id);

                // Nếu có ít nhất 1 buổi học, lưu thông tin về buổi học
                if ($currentClassSubjects->count() > 0) {
                    $currentClassSubject = $currentClassSubjects->first();
                    $dataDay['start_time'] = $currentClassSubject->start_time;
                    $dataDay['end_time'] = $currentClassSubject->end_time;
                    $dataDay['room_number'] = $currentClassSubject->room_number;
                    $dataDay['start_date'] = $currentClassSubject->start_date;
                    $dataDay['end_date'] = $currentClassSubject->end_date;
                    $day[] = $dataDay;
                }
            }

            // Thêm thông tin về ngày và các buổi học của môn học vào mảng kết quả
            $dataS['day'] = $day;
            $result[] = $dataS;
        }

        // Trả về mảng kết quả
        return $result;
    }
}
