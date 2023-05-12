<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Http\Requests\ExamRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    function list(Request $request) {
        $data['getRecord'] = Exam::getRecord();
        return view('admin.exam.list', $data);
    }

    public function getData()
    {
        $data['data'] = Exam::getRecord();
        return $data;
    }

    public function add(Request $request)
    {
        return view('admin.exam.add');
    }

    public function edit($id)
    {

        $getRecord = Exam::find($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
        }
        return view('admin.exam.edit', $data);
    }

    public function addExam(ExamRequest $request)
    {
        $exam = new Exam();
        $exam->name = ($request->name);
        $exam->description = ($request->description);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/exam/list')->with('success', 'Exam Successfully Created ');
    }

    public function update(ExamRequest $request, $id)
    {
        $save = Exam::find($id);
        $save->name = $request->name;
        $save->description = ($request->description);
        $save->created_by = Auth::user()->id;
        $save->save();
        return redirect('admin/exam/list')->with('success', 'Exam  updated successfully  ');
    }

    public function delete($id)
    {
        $subject = Exam::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/exam/list')->with('success', 'Exam successfully deleted ');
    }

    public function export()
    {
        return Excel::download(new ExamExport, 'exam.xlsx');
    }

    public function examSchedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        $result = array();
        if (!empty($request->exam_id) && !empty($request->class_id)) {
            $getSubject = ClassSubject::MySubject($request->class_id);
            foreach ($getSubject as $value) {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type;
                $examSchedule = ExamSchedule::getRecordSignle($request->exam_id, $request->class_id, $value->subject_id);
                if (!empty($examSchedule)) {
                    $dataS['exam_date'] = $examSchedule->exam_date;
                    $dataS['start_time'] = $examSchedule->start_time;
                    $dataS['end_time'] = $examSchedule->end_time;
                    $dataS['room_number'] = $examSchedule->room_number;
                    $dataS['full_mark'] = $examSchedule->full_mark;
                    $dataS['passing_mark'] = $examSchedule->passing_mark;
                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['passing_mark'] = '';
                }
                $result[] = $dataS;
            }
        }
        $data['getRecord'] = $result;
        return view('admin.exam.schedule', $data)->with('success', 'My Time Table Teacher ');
    }

    public function examScheduleInsert(Request $request)
    {
        ExamSchedule::deleteRecord($request->exam_id, $request->class_id);

        foreach ($request->schedule as $schedule) {
            if (!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number']) && !empty($schedule['full_mark']) && !empty($schedule['passing_mark'])) {
                $save = new ExamSchedule;
                $save->exam_id = $request->exam_id;
                $save->class_id = $request->class_id;
                $save->subject_id = $schedule['subject_id'];
                $save->exam_date = $schedule['exam_date'];
                $save->start_time = $schedule['start_time'];
                $save->end_time = $schedule['end_time'];
                $save->room_number = $schedule['room_number'];
                $save->full_mark = $schedule['full_mark'];
                $save->passing_mark = $schedule['passing_mark'];
                $save->created_by = Auth::user()->id;
                $save->save();
            }
            return redirect()->back()->with('error', 'Please fill in all the information');
        }

        return redirect()->back()->with('success', 'Exam Schedule successfully created ');
    }

    //student
    public function myExam(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $getExam = ExamSchedule::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimeTable = ExamSchedule::getExamTimeTable($value->exam_id, $class_id);

            $resultS = array();
            foreach ($getExamTimeTable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }

        $data['getRecord'] = $result;

        return view('student.my_exam', $data);
    }

    //teacher
    public function myExamTeacher(Request $request)
    {
        $result = array();
        $getClass = ClassTeacher::getMyClassTeacher(Auth::user()->id);
        foreach ($getClass as $class) {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $getExam = ExamSchedule::getExamTeacher($class->class_id,$class->subject_id);
            $examArray = array();
            foreach ($getExam as $exam) {
                $dataE = array();
                $dataE['name'] = $exam->exam_name;
                $getExamTimeTable = ExamSchedule::getExamTimeTableTeacher($exam->exam_id, $class->class_id,$class->subject_id);
                $subjectArray = array();
                foreach ($getExamTimeTable as $valueS) {
                    $dataS = array();
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_mark'] = $valueS->full_mark;
                    $dataS['passing_mark'] = $valueS->passing_mark;
                    $subjectArray[] = $dataS;
                }
                $dataE['subject'] = $subjectArray;
                $examArray[] = $dataE;
            }
            $dataC['exam'] = $examArray;
            $result[] = $dataC;

        }
        $data['getRecord'] = $result;

        return view('teacher.my_exam', $data);
    }
}
