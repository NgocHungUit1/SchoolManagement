<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Http\Requests\ExamRequest;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Subject;
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
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        return view('admin.exam.add', $data);
    }

    public function edit($id)
    {

        $getRecord = Exam::find($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
        }
        return view('admin.exam.edit', $data);
    }

    public function addExam(ExamRequest $request)
    {
        $exam = new Exam();
        $exam->name = ($request->name);
        $exam->class_id = ($request->class_id);
        $exam->subject_id = ($request->subject_id);
        $exam->start_time = ($request->start_time);
        $exam->end_time = ($request->end_time);
        $exam->status = ($request->status);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/exam/list')->with('success', 'Exam Successfully Created ');
    }

    public function update(ExamRequest $request, $id)
    {
        $save = Exam::find($id);
        $save->name = $request->name;
        $save->class_id = $request->class_id;
        $save->subject_id = $request->subject_id;
        $save->start_time = $request->start_time;
        $save->end_time = $request->end_time;
        $save->created_at = $request->created_at;
        $save->status = $request->status;
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

    public function examScore($id)
    {
        $data['getRecord'] = Exam::getStudent($id);
        return view('admin.exam_score.student', $data);
    }

    public function export()
    {
        return Excel::download(new ExamExport, 'exam.xlsx');
    }
}
