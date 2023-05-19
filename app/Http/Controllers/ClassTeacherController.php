<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTeacherRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Subject;
use App\Models\User;
use App\Services\ClassTeacherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTeacherController extends Controller
{
    protected $classTeacherService;

    public function __construct(ClassTeacherService $classTeacherService)
    {
        $this->classTeacherService = $classTeacherService;
    }

    public function list()
    {
        $data['getRecord'] = $this->classTeacherService->getList();

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
        $result = $this->classTeacherService->add($request->validated());

        return redirect('admin/assign_class_teacher/list')->with($result['status'], $result['message']);
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
        $result = $this->classTeacherService->update($id, $request->validated());

        return redirect('admin/assign_class_teacher/list')->with($result['status'], $result['message']);
    }

    public function delete($id)
    {
        $result = $this->classTeacherService->delete($id);

        return redirect('admin/assign_class_teacher/list')->with($result['status'], $result['message']);
    }

    public function mySubjectClass()
    {
        $data['getRecord'] = $this->classTeacherService->getMySubjectClass(Auth::user()->id);

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

