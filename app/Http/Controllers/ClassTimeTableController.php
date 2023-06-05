<?php

/**
 *  ClassTimeTableController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\AssignTeacherRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\Subject;
use App\Models\Week;
use App\Services\ClassTimeTableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ClassTimeTableController
 *
 * @category ClassTimeTable
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */

class ClassTimeTableController extends Controller
{

    /**
     * ClassTimeTableService instance.
     *
     * @var ClassTimeTableService
     */
    protected $classTimeTableService;


    /**
     * ClassTimeTableController constructor.
     *
     * @param ClassTimeTableService $classTimeTableService ClassTimeTableService
     *
     * @return void
     */
    public function __construct(ClassTimeTableService $classTimeTableService)
    {
        $this->classTimeTableService = $classTimeTableService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\View\View
     */
    public function list(Request $request)
    {
        $class_id = $request->input('class_id');
        $subject_id = $request->input('subject_id');
        $semester_id = $request->input('semester_id');

        $data = ClassTimetableService::getClassTimetable($class_id, $subject_id, $semester_id);

        return view('admin.class_timetable.list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $classId = $request->input('class_id');
            $subjectId = $request->input('subject_id');
            $semesterId = $request->input('semester_id');
            $timetable = $request->input('timetable');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $createClassTimeTable = $this->classTimeTableService
                ->createClassTimeTable($classId, $subjectId, $semesterId, $timetable, $startDate, $endDate);

            if ($createClassTimeTable) {
                return redirect()->back()
                    ->with('success', 'Class time table successfully created');
            } else {
                return back()->withInput()
                    ->with('error', 'Time slot overlaps.');
            }
        }


        return redirect()->back()
            ->with('success', 'Class Time table successfully created ');
    }


    /**
     * Get subject list by class id.
     *
     * @param Request $request The HTTP request
     *
     * @return string JSON response
     */
    public function getSubject(Request $request)
    {

        $getSubject = ClassSubject::MySubject($request->class_id);
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>"
                . $value->subjects->name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    /**
     * Display the time table of current teacher for given class and subject.
     *
     * @param int     $class_id   The ID of the class_id
     * @param int     $subject_id The ID of the subject_id
     * @param int     $semester_id The ID of the semester_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function myTimeTableTeacher($class_id, $subject_id, $semester_id)
    {
        $result = $this->classTimeTableService
            ->getTeacherTimeTable($class_id, $subject_id, $semester_id);

        return response()->json($result);
    }
}
