<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    function list() {

        $data['getRecord'] = User::getStudent();

        return view('admin.student.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        return view('admin.student.add', $data);
    }
    public function edit($id)
    {

        $data['getRecord'] = User::getUserId($id);
        if (!empty($data['getRecord'])) {
            $data['getClass'] = ClassModel::getClass();
        } else {
            abort(404);
        }

        return view('admin.student.edit', $data);
    }

    public function addStudent(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'class_id' => 'required',
            'admission_number' => 'required|unique:users',
            'mobile_number' => 'max:15|min:8',

        ],
            [
                'email.unique' => 'Email c đã có,xin điền email khác',
                'admission_number.unique' => 'Id student đã có,xin điền IDs khác',
                'class_id.required' => 'Tên danh mục khong được bỏ trống',
            ]
        );

        $student = new User();
        $student->name = trim($request->name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        $student->date_of_birth = $request->date_of_birth;
        $student->mobile_number = $request->mobile_number;
        // if (!empty($request->file('user_avatar'))) {
        //     $ext = $request->file('user_avatar')->getClientOriginalExtension();
        //     $file = $request->file('user_avatar');
        //     $randomStr = Str::random(20);
        //     $file_name = strtolower($randomStr) . '.' . $ext;
        //     $file->move('public/upload/profile/', $file_name);
        //     $student->user_avatar = $file_name;
        // }
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $student->user_avatar = $new_image;
        }

        $student->status = trim($request->status);
        $student->password = Hash::make($request->password);
        $student->email = trim($request->email);
        $student->user_type = 3;
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student successfully created ');
    }

    public function editStudent(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'admission_number' => 'required|unique:users,admission_number,' . $id,
            'class_id' => 'required',
            'mobile_number' => 'max:15|min:8',

        ],
            [
                'admission_number.unique' => 'Id student đã có,xin điền IDs khác',
                'email.unique' => 'Email c đã có,xin điền email khác',
                'class_id.required' => 'Tên danh mục khong được bỏ trống',
            ]
        );

        $student = User::getUserId($id);
        $student->name = trim($request->name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        $student->date_of_birth = $request->date_of_birth;
        $student->mobile_number = $request->mobile_number;
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/' . $student->user_avatar;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $student->user_avatar = $new_image;
        }
        $student->email = trim($request->email);
        $student->status = trim($request->status);
        if (!empty($request->password)) {
            $student->password = Hash::make($request->password);
        }
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student successfully updated ');
    }

    public function delete($id)
    {
        $student = User::find($id);
        $student->is_delete = 1;
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student successfully deleted ');
    }

    

}
