<?php

/**
 *  ClassTimeTableService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\ClassTeacher;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Week;
use Illuminate\Support\Facades\Auth;

/**
 * ClassTimeTableService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class ClassTimeTableService
{
    /**
     * ClassTimeTableService::getClassTimetable()
     *
     * Gets data for all class time table.
     *
     * @param Request $request The HTTP request
     *
     * @return array
     */
    public static function getClassTimetable(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::MySubject($request->class_id);
        }
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['ClassSubjectDate'] = ClassSubjectTimeTable::getDate(
            $request->class_id,
            $request->subject_id,
            $request->semester_id,
        );
        $getDay = Week::getRecord();
        $day = array();
        foreach ($getDay as $value) {
            $dataDay = array();
            $dataDay['day_id'] = $value->id;
            $dataDay['day_name'] = $value->name;
            if (!empty($request->class_id) && !empty($request->subject_id) && !empty($request->semester_id)) {
                $ClassSubject = ClassSubjectTimeTable::getRecord(
                    $request->class_id,
                    $request->subject_id,
                    $value->id,
                    $request->semester_id,
                );
                if (!empty($ClassSubject)) {
                    $dataDay['start_time'] = $ClassSubject->start_time;
                    $dataDay['end_time'] = $ClassSubject->end_time;
                    $dataDay['room_number'] = $ClassSubject->room_number;
                } else {
                    $dataDay['start_time'] = '';
                    $dataDay['end_time'] = '';
                    $dataDay['room_number'] = '';
                }
            } else {
                $dataDay['start_time'] = '';
                $dataDay['end_time'] = '';
                $dataDay['room_number'] = '';
            }
            $day[] = $dataDay;
        }
        $data['day'] = $day;

        return $data;
    }

    /**
     * ClassTimeTableService::createClassTimeTable()
     *
     * Add new class time table.
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\View\View
     */
    public function createClassTimeTable($request)
    {
        $overlapping = false;
        $existingRecords = ClassSubjectTimeTable::where(
            'class_id',
            '=',
            $request->class_id
        )
            ->where('subject_id', '=', $request->subject_id)
            ->where('semester_id', '=', $request->semester_id)
            ->get();
        if (count($existingRecords) > 0) {
            $existingRecordsIds = $existingRecords->pluck('id')->toArray();
            ClassSubjectTimeTable::destroy($existingRecordsIds);
        }

        if (!empty($request->timetable)) {
            foreach ($request->timetable as $timetable) {
                if (
                    !empty($timetable['day_id'])
                    && !empty($timetable['start_time'])
                    && !empty($timetable['end_time'])
                    && !empty($timetable['room_number'])
                ) {
                    $overlappingCount = $this->_checkTimeSlotOverlap(
                        $request->class_id,
                        $timetable,
                        $request->semester_id,
                    );
                    if ($overlappingCount > 0) {
                        $overlapping = true;
                    } else {
                        $save = new ClassSubjectTimeTable(
                            [
                                'class_id' => $request->class_id,
                                'subject_id' => $request->subject_id,
                                'semester_id' => $request->semester_id,
                                'day_id' => $timetable['day_id'],
                                'start_time' => $timetable['start_time'],
                                'end_time' => $timetable['end_time'],
                                'room_number' => $timetable['room_number'],
                                'start_date' => $request->start_date,
                                'end_date' => $request->end_date,
                            ]
                        );
                        $save->save();
                    }
                }
            }
        }

        if ($overlapping) {
            return false;
        } else {
            return true;
        }
    }




    /**
     * Check Time Slot Overlap.
     *
     * @param int $class_id  The ID of the class_id
     * @param int $timetable The ID of the timetable
     *
     * @return \Illuminate\View\View
     */
    private function _checkTimeSlotOverlap($class_id, $timetable, $semester_id)
    {
        $overlapping = ClassSubjectTimeTable::where(
            [
                ['class_id', '=', $class_id],
                ['day_id', '=', $timetable['day_id']],
                ['semester_id', '=', $semester_id]
            ]
        )->where(
            function ($query) use ($timetable) {
                $query->where(
                    function ($q) use ($timetable) {
                        $q->whereBetween(
                            'start_time',
                            [
                                $timetable['start_time'],
                                $timetable['end_time']
                            ]
                        );
                    }
                )
                    ->orWhere(
                        function ($q) use ($timetable) {
                            $q->whereBetween(
                                'end_time',
                                [
                                    $timetable['start_time'],
                                    $timetable['end_time']
                                ]
                            );
                        }
                    )
                    ->orWhere(
                        function ($q) use ($timetable) {
                            $q->where('start_time', '<=', $timetable['start_time'])
                                ->where('end_time', '>=', $timetable['end_time']);
                        }
                    );
            }
        )->count();

        return $overlapping;
    }

    /**
     * Get my time table(student,teacher).
     *
     * @return \Illuminate\View\View
     */
    public function getMyTimeTable()
    {
        $result = [];
        $getRecord = ClassSubject::MySubject(Auth::user()->class_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->subject_name;
            $getDay = Week::getRecord();
            $day = [];
            foreach ($getDay as $valueDay) {
                $dataDay = [];
                $dataDay['day_name'] = $valueDay->name;
                $ClassSubject = ClassSubjectTimeTable::getRecord(
                    $value->class_id,
                    $value->subject_id,
                    $valueDay->id,
                    $value->semester_id,
                );
                if (!empty($ClassSubject)) {
                    $dataDay['start_time'] = $ClassSubject->start_time;
                    $dataDay['end_time'] = $ClassSubject->end_time;
                    $dataDay['room_number'] = $ClassSubject->room_number;
                } else {
                    $dataDay['start_time'] = '';
                    $dataDay['end_time'] = '';
                    $dataDay['room_number'] = '';
                }
                $day[] = $dataDay;
            }
            $dataS['day'] = $day;
            $result[] = $dataS;
        }

        return $result;
    }

    /**
     * Get my time table(student,teacher).
     *
     * @param int     $class_id   The ID of the class
     * @param int     $subject_id The ID of the subject
     * @param Request $request    The HTTP request
     *
     * @return \Illuminate\View\View
     */
    public function getTeacherTimeTable($class_id, $subject_id, Request $request)
    {
        $data['getClass'] = ClassModel::find($class_id);
        $data['getSubject'] = Subject::find($subject_id);
        $data['ClassSubjectDate'] = ClassSubjectTimeTable::getDate(
            $request->class_id,
            $request->subject_id,
            $request->semester_id
        );

        $getDay = Week::getRecord();
        $day = [];

        foreach ($getDay as $valueDay) {
            $dataDay = [];
            $dataDay['day_name'] = $valueDay->name;
            $dataDay['day_id'] = $valueDay->id;
            $ClassSubject = ClassSubjectTimeTable::getRecord(
                $class_id,
                $subject_id,
                $valueDay->id,
                $request->semester_id,
            );

            if (!empty($ClassSubject)) {
                $dataDay['start_time'] = $ClassSubject->start_time;
                $dataDay['end_time'] = $ClassSubject->end_time;
                $dataDay['room_number'] = $ClassSubject->room_number;
                $dataDay['start_date'] = $ClassSubject->start_date;
                $dataDay['end_date'] = $ClassSubject->end_date;
            } else {
                $dataDay['start_time'] = '';
                $dataDay['end_time'] = '';
                $dataDay['room_number'] = '';
                $dataDay['start_date'] = '';
                $dataDay['end_date'] = '';
            }

            $result[] = $dataDay;
        }

        return $result;
    }
}
