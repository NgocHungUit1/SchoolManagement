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

use Illuminate\Http\Request;
use App\Services\CalendarService;
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

    /**
     * CalendarController constructor.
     *
     * @param CalendarService $calendarService CalendarService
     *
     * @return void
     */
    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    /**
     * Shows the calender student.
     *
     * @return mixed Calendar
     */
    public function myCalendar()
    {
        $data['getTimeTable'] = $this->calendarService
            ->getTimeTable(Auth::user()->class_id);
        $data['getExamTimeTable'] = $this->calendarService
            ->getExamTimeTable(Auth::user()->class_id);
        return view('student.my_calendar', $data)
            ->with('success', 'My Time Table Student ');
    }

    /**
     * Shows the calender teacher.
     *
     * @return mixed Calendar
     */
    public function myTeacherCalendar()
    {
        $teacher_id = Auth::user()->id;
        $data['getCalendarTeacher'] = ClassTeacher::getCalendarTeacher($teacher_id);
        return view('teacher.my_calendar', $data)
            ->with('success', 'My Time Table Teacher ');
    }
}
