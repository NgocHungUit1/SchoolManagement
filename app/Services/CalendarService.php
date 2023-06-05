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
use Illuminate\Support\Facades\DB;

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
        $getExam = ExamSchedule::getMyExam($semester_id, $class_id);
        return $getExam;
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
        return ClassSubjectTimeTable::getTimeTable($semester_id, $class_id);
    }
}
