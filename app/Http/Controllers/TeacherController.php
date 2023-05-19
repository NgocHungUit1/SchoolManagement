<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use App\Services\TeacherService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{


    protected $service;

    public function __construct(TeacherService $service)
    {
        $this->service = $service;
    }

    function list() {
        $data['getRecord'] = User::getTeacher();
        return view('admin.teacher.list', $data);
    }

    public function getData()
    {
        $data['data'] = User::getTeacher();

        return $data;
    }

    public function add()
    {

        $data['getSubject'] = Subject::getSubject();
        // dd($data);
        return view('admin.teacher.add', $data);
    }
    public function edit($id)
    {

        $data['getRecord'] = User::find($id);
        if (!empty($data['getRecord'])) {
            $data['getSubject'] = Subject::getSubject();
        } else {
            abort(404);
        }

        return view('admin.teacher.edit', $data);
    }

    public function addTeacher(TeacherRequest $request)
    {
        $this->service->createTeacher($request);

        return redirect('admin/teacher/list')->with('success', 'Teacher successfully created');
    }


    public function editTeacher(UpdateTeacherRequest $request, $id)
    {
        $this->service->updateTeacher($request, $id);
        return redirect('admin/teacher/list')->with('success', 'Teacher successfully updated');
    }
    public function delete($id)
    {
        $teacher = User::find($id);
        if (!empty($teacher)) {
            $teacher->is_delete = 1;
            $teacher->save();
            return redirect('admin/teacher/list')->with('success', 'teacher successfully deleted ');
        } else {
            abort(404);
        }

    }
    public function myStudent()
    {
        $data['getRecord'] = ClassModel::getStudentTeacher(Auth::user()->id);
        return view('teacher.my_student_class', $data);

    }

    public function viewStudent($id)
    {
        $data['getRecord'] = ClassModel::getStudent($id);
        $data['getClass'] = ClassModel::find($id);
        return view('admin.class.view', $data);
    }

    public function getClass()
    {
        $data['getRecord'] = ClassModel::getTeacherClass(Auth::user()->id);

        return view('teacher.my_student_class', $data);

    }

    public function getStudent()
    {
        $data['getRecord'] = User::getStudentTeacher(Auth::user()->id);
        return $data;

    }



}
