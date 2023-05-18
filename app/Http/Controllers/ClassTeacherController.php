<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTeacherRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTeacherController extends Controller
{
    function list()
    {
        $data['getRecord'] = ClassTeacher::getRecord();

        return view('admin.assign_class_teacher.list', $data);
    }

    public function getData()
    {
        $data['data'] = ClassTeacher::getRecord();

        return $data;
    }
    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacher();
        return view('admin.assign_class_teacher.add', $data);
    }

    public function assignTeacherClass(AssignTeacherRequest $request)
    {
        $teacher_id = $request->teacher_id;
        $getAlreadyTeacher = ClassTeacher::getAlreadyTeacher($request->class_id, $request->subject_id);

        if (!empty($getAlreadyTeacher)) {
            // Nếu đã có giáo viên dạy môn học cho lớp học đó rồi thì return với thông báo
            if ($getAlreadyTeacher->teacher_id == $teacher_id) {
                // Trường hợp giáo viên đã được phân công dạy môn học cho lớp học đó rồi
                return redirect('admin/assign_class_teacher/list')->with('warning', 'Teacher Assigned already exist');
            } else {
                // Trường hợp môn học và lớp học đã được phân công cho một giáo viên khác
                return redirect('admin/assign_class_teacher/list')->with('warning', 'Subject and Class already assigned to another teacher');
            }
        } else {
            // Nếu chưa có giáo viên dạy môn học cho lớp học đó thì tiến hành phân công
            $data = $request->validated();
            $data['created_by'] = Auth::user()->id;
            ClassTeacher::create($data);

            return redirect('admin/assign_class_teacher/list')->with('success', 'Class Assigned Successfully');
        }
    }



    public function edit($id)
    {
        $getRecord = ClassTeacher::find($id);
        $data['getSubject'] = Subject::getSubject();
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacher();
        }

        return view('admin.assign_class_teacher.edit', $data);
    }

    public function update(AssignTeacherRequest $request, $id)
    {
        $teacher_id = $request->teacher_id;
        $getAlreadyTeacher = ClassTeacher::getAlreadyTeacher($request->class_id, $request->subject_id);
        if (!empty($getAlreadyTeacher)) {
            // Nếu đã có giáo viên dạy môn học cho lớp học đó rồi thì return với thông báo
            if ($getAlreadyTeacher->teacher_id == $teacher_id) {
                // Trường hợp giáo viên đã được phân công dạy môn học cho lớp học đó rồi
                return redirect('admin/assign_class_teacher/list')->with('warning', 'Teacher Assigned already exist');
            } else {
                // Trường hợp môn học và lớp học đã được phân công cho một giáo viên khác
                return redirect('admin/assign_class_teacher/list')->with('warning', 'Subject and Class already assigned to another teacher');
            }
        } else {
            $save = ClassTeacher::findOrFail($id);
            $data = $request->validated();
            $save->update($data);
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

    public function get_Teacher(Request $request)
    {

        $get_Teacher = User::SubjectTeacher($request->subject_id);
        $html = "<option value=''> Select </option>";
        foreach ($get_Teacher as $value) {
            $html .= "<option value='" . $value->id . "'>" . $value->teacher_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
