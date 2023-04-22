<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTeacherController extends Controller
{
    function list(Request $request) {
        $data['getRecord'] = ClassTeacher::getRecord();

        return view('admin.assign_class_teacher.list', $data);

    }
    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacher();
        return view('admin.assign_class_teacher.add', $data);
    }

    public function assignTeacherClass(Request $request)
    {

        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlready = ClassTeacher::getAlreadyFirst($request->class_id, $teacher_id);
                if (!empty($getAlready)) {
                    $getAlready->status = $request->status;
                    $getAlready->save();
                } else {

                    $save = new ClassTeacher();
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            }
            return redirect('admin/assign_class_teacher/list')->with('success', 'Class Assigned Successfully');
        } else {

            return redirect()->back()->with('error', 'Class Assigned Fail ');
        }
    }

    public function edit($id)
    {

        $getRecord = ClassTeacher::find($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherId'] = ClassTeacher::getAssignTeacherId($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacher();
        }
        return view('admin.assign_class_teacher.edit', $data);
    }

    public function update(Request $request)
    {
        ClassTeacher::deleteSubject($request->class_id);
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlready = ClassTeacher::getAlreadyFirst($request->class_id, $teacher_id);
                if (!empty($getAlready)) {
                    $getAlready->status = $request->status;
                    $getAlready->save();
                } else {

                    $save = new ClassTeacher();
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
        }
        return redirect('admin/assign_class_teacher/list')->with('success', 'Assign Class Teacher Updated Successfully');
    }

    public function delete($id)
    {
        $subject = ClassTeacher::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/assign_class_teacher/list')->with('success', ' Class Teacher successfully deleted ');
    }
    public function mySubjectClass()
    {
        $data['getRecord'] = ClassTeacher::getMyClassSubject(Auth::user()->id);
        return view('teacher.my_subject_class', $data);
    }
}
