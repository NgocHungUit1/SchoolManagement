<?php

namespace App\Http\Controllers;

use App\Exports\AssignSubjectExport;
use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClassSubjectController extends Controller
{
    function list() {
        $data['getRecord'] = ClassSubject::getRecord();
        return view('admin.assign_subject.list', $data);
    }

    public function getData()
    {
        $data['data'] = ClassSubject::getRecord();
        return $data;
    }

    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        return view('admin.assign_subject.add', $data);
    }
    public function edit($id)
    {

        $getRecord = ClassSubject::find($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectId'] = ClassSubject::getAssignSubjectId($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
        }
        return view('admin.assign_subject.edit', $data);
    }

    public function assignSubject(AssignSubjectClassRequest $request)
    {
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlready = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                $status = $request->status;

                $getAlready ? $getAlready->update(compact('status')) : ClassSubject::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $subject_id,
                    'status' => $status,
                    'created_by' => Auth::user()->id,
                ]);
            }

            return redirect('admin/assign_subject/list')->with('success', 'subject assign class created successfully  ');
        } else {
            return redirect()->back()->with('error', 'Please select at least one subject.');
        }
    }

    public function update(AssignSubjectClassRequest $request)
    {
        ClassSubject::deleteSubject($request->class_id);
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlready = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                $status = $request->status;

                $getAlready ? $getAlready->update(compact('status')) : ClassSubject::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $subject_id,
                    'status' => $status,
                    'created_by' => Auth::user()->id,
                ]);
            }

        }
        return redirect('admin/assign_subject/list')->with('success', 'subject assign class updated successfully  ');
    }

    public function delete($id)
    {
        $subject = ClassSubject::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/assign_subject/list')->with('success', 'Subject successfully deleted ');
    }
    public function export()
    {
        return Excel::download(new AssignSubjectExport, 'assign_subject.xlsx');
    }
}
