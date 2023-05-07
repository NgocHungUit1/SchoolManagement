<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    function list() {

        $data['getRecord'] = User::getStudent();

        return view('admin.student.list', $data);
    }

    public function getData()
    {
        $data['data'] = User::getStudent();
        return $data;
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

    public function addStudent(InsertStudentRequest $request)
    {
        $student = new User();
        $student->name = ($request->name);
        $student->admission_number = ($request->admission_number);
        $student->roll_number = ($request->roll_number);
        $student->class_id = ($request->class_id);
        $student->gender = ($request->gender);
        $student->date_of_birth = $request->date_of_birth;
        $student->mobile_number = $request->mobile_number;
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $student->user_avatar = $new_image;
        }

        $student->status = ($request->status);
        $student->password = Hash::make($request->password);
        $student->email = ($request->email);
        $student->user_type = 3;
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student successfully created ');
    }

    public function editStudent(UpdateStudentRequest $request, $id)
    {
        $student = User::getUserId($id);
        $student->name = ($request->name);
        $student->roll_number = ($request->roll_number);
        $student->class_id = ($request->class_id);
        $student->gender = ($request->gender);
        $student->date_of_birth = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->toDateTimeString();
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
        $student->status = ($request->status);
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
