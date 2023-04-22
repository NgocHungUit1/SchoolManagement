<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CLassSubjectController extends Controller
{
    function list(Request $request) {
        $data['getRecord'] = ClassSubject::getRecord();
        return view('admin.assign_subject.list', $data);

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

    public function assignSubject(Request $request)
    {
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlready = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlready)) {
                    $getAlready->status = $request->status;
                    $getAlready->save();
                } else {

                    $save = new ClassSubject();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            }
            return redirect('admin/assign_subject/list')->with('success', 'subject assign class successfully c ');
        } else {

            return redirect()->back()->with('error', 'Password and confirm password not match ');
        }
    }

    public function update(Request $request)
    {
        ClassSubject::deleteSubject($request->class_id);
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlready = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlready)) {
                    $getAlready->status = $request->status;
                    $getAlready->save();
                } else {

                    $save = new ClassSubject();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

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
}
