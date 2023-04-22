<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    function list() {
        $data['getRecord'] = User::getTeacher();
        return view('admin.teacher.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        return view('admin.teacher.add', $data);
    }
    public function edit($id)
    {

        $data['getRecord'] = User::getUserId($id);
        // if (!empty($data['getRecord'])) {
        //     $data['getClass'] = ClassModel::getClass();
        // } else {
        //     abort(404);
        // }

        return view('admin.teacher.edit', $data);
    }

    public function addteacher(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'teacher_id' => 'required|unique:users',
            'mobile_number' => 'max:15|min:8',
        ],
            [
                'email.unique' => 'Email đã có,xin điền email khác',
                'teacher_id.unique' => 'Id teacher đã có,xin điền ID khác',

            ]
        );

        $teacher = new User();
        $teacher->name = trim($request->name);
        $teacher->teacher_id = trim($request->teacher_id);
        $teacher->joining_date = trim($request->joining_date);
        $teacher->qualification = trim($request->qualification);
        $teacher->experience = trim($request->experience);
        $teacher->address = trim($request->address);
        // $teacher->class_id = trim($request->class_id);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = $request->date_of_birth;
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

        $teacher->status = trim($request->status);
        $teacher->password = Hash::make($request->password);
        $teacher->email = trim($request->email);
        $teacher->user_type = 2;
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', 'Teacher successfully created ');
    }

    public function editteacher(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'teacher_id' => 'required|unique:users,teacher_id,' . $id,
            'mobile_number' => 'max:15|min:8',

        ],
            [
                'teacher_id.unique' => 'Id teacher đã có,xin điền IDs khác',
                'email.unique' => 'Email c đã có,xin điền email khác',
            ]
        );

        $teacher = User::getUserId($id);
        $teacher->name = trim($request->name);
        $teacher->teacher_id = trim($request->teacher_id);
        $teacher->joining_date = trim($request->joining_date);
        $teacher->qualification = trim($request->qualification);
        $teacher->experience = trim($request->experience);
        $teacher->address = trim($request->address);
        // $teacher->class_id = trim($request->class_id);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = $request->date_of_birth;
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
        $teacher->email = trim($request->email);
        $teacher->status = trim($request->status);
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

}
