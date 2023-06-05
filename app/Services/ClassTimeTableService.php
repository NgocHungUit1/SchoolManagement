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
use Illuminate\Support\Facades\DB;

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

    //Sử dụng method keyBy để biến đổi classSubjectList thành một associative array với key là day_id, giúp việc tìm kiếm thông tin cho ngày học trở nên nhanh chóng hơn.
    // Sử dụng method map thay vì foreach để sinh ra một mảng mới được biến đổi từ mảng daysOfWeek ban đầu. Method map sẽ trả về một collection mới sau khi áp dụng callback function truyền vào trên mỗi phần tử của mảng gốc.
    // Sử dụng toArrayOf để chuyển collection thành mảng.
    public static function getClassTimetable($class_id, $subject_id, $semester_id)
    {
        $daysOfWeek = Week::all();

        $classSubjectList = ClassSubjectTimeTable::getRecord(
            [$class_id],
            [$subject_id],
            Week::pluck('id')->toArray(),
            $semester_id
        )->keyBy('day_id');

        $data = [
            'getClass' => ClassModel::getClass(),
            'getExamSemester' => Semester::whereIn('id', [1, 2])->get(),
            'ClassSubjectDate' => ClassSubjectTimeTable::getDate($class_id, $subject_id, $semester_id),
            'getSubject' => !empty($class_id) ? ClassSubject::MySubject($class_id) : null,
            'day' => $daysOfWeek->map(function ($day) use ($classSubjectList) {
                $classSubject = $classSubjectList->get($day->id);
                return [
                    'day_id' => $day->id,
                    'day_name' => $day->name,
                    'start_time' => $classSubject ? $classSubject->start_time : '',
                    'end_time' => $classSubject ? $classSubject->end_time : '',
                    'start_date' => $classSubject ? $classSubject->start_date : '',
                    'end_date' => $classSubject ? $classSubject->end_date : '',
                    'room_number' => $classSubject ? $classSubject->room_number : '',
                ];
            })->toArray(),
        ];

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
    public function createClassTimeTable($classId, $subjectId, $semesterId, $timetable, $startDate, $endDate)
    {
        $overlapping = false;
        $existingRecords = ClassSubjectTimeTable::where([
            ['class_id', '=', $classId],
            ['subject_id', '=', $subjectId],
            ['semester_id', '=', $semesterId],
        ])->get();

        if ($existingRecords->isNotEmpty()) {
            $existingRecords->pluck('id')->each(function ($id) {
                ClassSubjectTimeTable::destroy($id);
            });
        }

        foreach ($timetable as $schedule) {
            if (
                !empty($schedule['day_id']) &&
                !empty($schedule['start_time']) &&
                !empty($schedule['end_time']) &&
                !empty($schedule['room_number'])
            ) {
                $overlapCount = $this->_checkTimeSlotOverlap(
                    $classId,
                    $schedule,
                    $semesterId
                );

                if ($overlapCount === 0) {
                    $table = new ClassSubjectTimeTable([
                        'class_id' => $classId,
                        'subject_id' => $subjectId,
                        'semester_id' => $semesterId,
                        'day_id' => $schedule['day_id'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'],
                        'room_number' => $schedule['room_number'],
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]);
                    $table->save();
                } else {
                    $overlapping = true;
                }
            }
        }

        return !$overlapping;
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
     * @param int     $class_id   The ID of the class
     * @param int     $subject_id The ID of the subject
     * @param Request $request    The HTTP request
     *
     * @return \Illuminate\View\View
     */
    public function getTeacherTimeTable($class_id, $subject_id, $semester_id)
    {
        $weekIDs = Week::pluck('id')->toArray();
        $classSubjectList = ClassSubjectTimeTable::getRecord([$class_id], [$subject_id], $weekIDs, $semester_id);
        $result = [];
        $getDay = Week::all();
        foreach ($getDay as $value) {
            $data['day_name'] = $value->name;
            $data['day_id'] = $value->id;

            $ClassSubject = $classSubjectList->where('class_id', $class_id)
                ->where('subject_id', $subject_id)
                ->where('day_id', $value->id)
                ->where('semester_id', $semester_id)
                ->first();

            $data['start_time'] = !empty($ClassSubject) ? $ClassSubject->start_time : '';
            $data['end_time'] = !empty($ClassSubject) ? $ClassSubject->end_time : '';
            $data['room_number'] = !empty($ClassSubject) ? $ClassSubject->room_number : '';
            $data['start_date'] = !empty($ClassSubject) ? $ClassSubject->start_date : '';
            $data['end_date'] = !empty($ClassSubject) ? $ClassSubject->end_date : '';

            $result[] = $data;
        }

        return $result;
    }
}
