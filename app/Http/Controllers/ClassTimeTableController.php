<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\Week;
use Illuminate\Http\Request;

class ClassTimeTableController extends Controller
{

    function list(Request $request) {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::MySubject($request->class_id);
        }
        $getDay = Week::getRecord();
        $day = array();
        foreach ($getDay as $value) {
            $dataDay = array();
            $dataDay['day_id'] = $value->id;
            $dataDay['day_name'] = $value->name;
            $day[] = $dataDay;
        }
        $data['day'] = $day;
        return view('admin.class_timetable.list', $data);

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

    public function add(Request $request)
    {

        ClassSubjectTimeTable::where('class_id', '=', $request->class_id)->where('subject_id', '=', $request->subject_id)->delete();

        foreach ($request->timetable as $timetable) {
            if (!empty($timetable['day_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])) {
                $save = new ClassSubjectTimeTable;
                $save->class_id = $request->class_id;
                $save->subject_id = $request->subject_id;
                $save->day_id = $timetable['day_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->room_number = $timetable['room_number'];
                $save->save();
            }
        }
        return redirect()->back()->with('success', 'Class Time table successfully created ');

    }
}
