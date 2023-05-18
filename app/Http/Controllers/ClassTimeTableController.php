<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTeacherRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\Subject;
use App\Models\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimeTableController extends Controller
{

    function list(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::MySubject($request->class_id);
        }
        $data['ClassSubjectDate'] = ClassSubjectTimeTable::getDate($request->class_id, $request->subject_id);
        $getDay = Week::getRecord();
        $day = array();
        foreach ($getDay as $value) {
            $dataDay = array();
            $dataDay['day_id'] = $value->id;
            $dataDay['day_name'] = $value->name;
            if (!empty($request->class_id) && !empty($request->subject_id)) {
                $ClassSubject = ClassSubjectTimeTable::getRecord($request->class_id, $request->subject_id, $value->id);
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

        ClassSubjectTimeTable::where('class_id', '=', $request->class_id)
            ->where('subject_id', '=', $request->subject_id)
            ->delete();

        foreach ($request->timetable as $timetable) {
            if (!empty($timetable['day_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])) {
                // Check for overlapping time slots
                $overlapping = ClassSubjectTimeTable::where([
                    ['class_id', '=', $request->class_id],
                    ['day_id', '=', $timetable['day_id']]
                ])->where(function ($query) use ($timetable) {
                    $query->where(function ($q) use ($timetable) {
                        $q->whereBetween('start_time', [$timetable['start_time'], $timetable['end_time']]);
                    })
                        ->orWhere(function ($q) use ($timetable) {
                            $q->whereBetween('end_time', [$timetable['start_time'], $timetable['end_time']]);
                        })
                        ->orWhere(function ($q) use ($timetable) {
                            $q->where('start_time', '<=', $timetable['start_time'])
                                ->where('end_time', '>=', $timetable['end_time']);
                        });
                })->count();

                if ($overlapping > 0) {
                    return redirect()->back()->with('error', 'Time slot overlap detected');
                }


                $save = new ClassSubjectTimeTable([
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id,
                    'day_id' => $timetable['day_id'],
                    'start_time' => $timetable['start_time'],
                    'end_time' => $timetable['end_time'],
                    'room_number' => $timetable['room_number'],
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
                $save->save();
            }
        }
        return redirect()->back()->with('success', 'Class Time table successfully created ');
    }

    //student
    public function myTimeTable()
    {
        $result = array();
        $getRecord = ClassSubject::MySubject(Auth::user()->class_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->subject_name;
            $getDay = Week::getRecord();
            $day = array();
            foreach ($getDay as $valueDay) {
                $dataDay = array();
                $dataDay['day_name'] = $valueDay->name;
                $ClassSubject = ClassSubjectTimeTable::getRecord($value->class_id, $value->subject_id, $valueDay->id);
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
        $data['getRecord'] = $result;

        return view('student.my_timetable', $data)->with('success', 'My Time Table Student ');
    }

    public function myTimeTableTeacher($class_id, $subject_id,Request $request)
    {

        $data['getClass'] = ClassModel::find($class_id);
        $data['getSubject'] = Subject::find($subject_id);
        $data['ClassSubjectDate'] = ClassSubjectTimeTable::getDate($request->class_id, $request->subject_id);
        $getDay = Week::getRecord();
        $day = array();
        foreach ($getDay as $valueDay) {
            $dataDay = array();
            $dataDay['day_name'] = $valueDay->name;
            $dataDay['day_id'] = $valueDay->id;
            $ClassSubject = ClassSubjectTimeTable::getRecord($class_id, $subject_id, $valueDay->id);
            // dd($ClassSubject);
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
         return response()->json($result);


    }
}
