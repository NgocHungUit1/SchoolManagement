<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
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
        $data['getClass'] = ClassModel::getClass();
        return view('admin.teacher.add', $data);
    }
    public function edit($id)
    {

        $data['getRecord'] = User::find($id);
        // if (!empty($data['getRecord'])) {
        //     $data['getClass'] = ClassModel::getClass();
        // } else {
        //     abort(404);
        // }
        return view('admin.teacher.edit', $data);
    }

    public function addTeacher(TeacherRequest $request)
    {
        $teacher = new User();
        $teacher->name = ($request->name);
        $teacher->teacher_id = ($request->teacher_id);
        $teacher->joining_date = ($request->joining_date);
        $teacher->qualification = ($request->qualification);
        $teacher->experience = ($request->experience);
        $teacher->address = ($request->address);
        $teacher->gender = ($request->gender);
        $teacher->date_of_birth = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->toDateTimeString();
        $teacher->mobile_number = $request->mobile_number;
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $teacher->user_avatar = $new_image;
        }

        $teacher->status = ($request->status);
        $teacher->password = Hash::make($request->password);
        $teacher->email = ($request->email);
        $teacher->user_type = 2;
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', 'Teacher successfully created ');
    }

    public function editTeacher(UpdateTeacherRequest $request, $id)
    {
        $teacher = User::getUserId($id);
        $teacher->name = ($request->name);
        $teacher->joining_date = ($request->joining_date);
        $teacher->qualification = ($request->qualification);
        $teacher->experience = ($request->experience);
        $teacher->address = ($request->address);
        // $teacher->class_id = ($request->class_id);
        $teacher->gender = ($request->gender);
        $teacher->date_of_birth = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->toDateTimeString();
        $teacher->mobile_number = $request->mobile_number;
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/' . $teacher->user_avatar;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $teacher->user_avatar = $new_image;
        }
        $teacher->status = ($request->status);
        if (!empty($request->password)) {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', 'teacher successfully updated ');
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
        $data['getRecord'] = User::getStudentTeacher(Auth::user()->id);
        return view('teacher.my_student', $data);

    }

    public function getStudent()
    {

        $data['getRecord'] = User::getStudentTeacher(Auth::user()->id);

        return $data;

    }

}
