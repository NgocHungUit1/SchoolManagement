<?php

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

class ClassTimeTableController extends Controller
{

    protected $classTimeTableService;

    public function __construct(ClassTimeTableService $classTimeTableService)
    {
        $this->classTimeTableService = $classTimeTableService;
    }

    public function list(Request $request)
    {
        $data = ClassTimetableService::getClassTimetable($request);
        return view('admin.class_timetable.list', $data);

    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $createClassTimeTable = $this->classTimeTableService->createClassTimeTable($request);

            if ($createClassTimeTable) {
                return redirect()->back()->with('success', 'Class Time table successfully created ');
            } else {
                return back()->withInput()->with('error', 'Time slot overlaps with another class timetable.');
            }
        }

        return redirect()->back()->with('success', 'Class Time table successfully created ');
    }

    public function get_Subject(Request $request)
    {

        $getSubject = ClassSubject::MySubject($request->class_id);
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>" . $value->subject_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }


    //student
    public function myTimeTable()
    {
        $myTimeTable = (new ClassTimetableService())->getMyTimeTable();
        $data['getRecord'] = $myTimeTable;

        return view('student.my_timetable', $data)->with('success', 'My Time Table Student ');
    }

    public function myTimeTableTeacher($class_id, $subject_id, Request $request)
    {
        $result = $this->classTimeTableService->getTeacherTimeTable($class_id, $subject_id, $request);

        return response()->json($result);
    }
}
