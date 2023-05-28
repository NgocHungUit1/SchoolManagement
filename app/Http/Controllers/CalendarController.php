<?php

/**
 *  CalendarController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Models\ClassTeacher;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Services\CalendarService;
use App\Services\ExamService;
use Illuminate\Support\Facades\Auth;

/**
 * CalendarController
 *
 * @category CalendarController
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class CalendarController extends Controller
{
    /**
     * CalendarService instance.
     *
     * @var CalendarService
     */
    protected $calendarService;
    protected $examService;

    /**
     * CalendarController constructor.
     *
     * @param CalendarService $calendarService CalendarService
     *
     * @return void
     */
    public function __construct(CalendarService $calendarService, ExamService $examService)
    {
        $this->calendarService = $calendarService;
        $this->examService = $examService;
    }

    /**
     * Shows the calender student.
     *
     * @return mixed Calendar
     */
    public function myCalendar(Request $request)
    {
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getTimeTable'] = $this->calendarService
            ->getTimeTable($request, Auth::user()->class_id);
        $data['getExamTimeTable'] = $this->calendarService
            ->getExamTimeTable($request, Auth::user()->class_id);
        return view('student.my_calendar', $data)
            ->with('success', 'My Time Table Student ');
    }

    /**
     * Shows the calender teacher.
     *
     * @return mixed Calendar
     */
    public function myTeacherCalendar(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $semester_id = $request->semester_id;
        $data['getCalendarTeacher'] = ClassTeacher::getCalendarTeacher($teacher_id, $semester_id);
        $data['getExamCalendar'] = $this->examService->getMyExamTeacher($request, $teacher_id);
        // dd($data);
        return view('teacher.my_calendar', $data)
            ->with('success', 'My Time Table Teacher ');
    }
}
