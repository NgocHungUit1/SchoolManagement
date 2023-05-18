<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();
        $data['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->toDateTimeString();
        $data['password'] = Hash::make($request->password);
        $data['user_type'] = 3;

        if ($request->hasFile('user_avatar')) {
            $path = 'public/uploads/profile/';
            $get_image = $request->file('user_avatar');
            $name_image = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $data['user_avatar'] = $new_image;
        }

        User::create($data);

        return redirect('admin/student/list')->with('success', 'Student successfully created ');
    }



    public function editStudent(UpdateStudentRequest $request, $id)
    {
        $student = User::findOrFail($id);
        $data = $request->validated();
        $data['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->toDateTimeString();

        if ($request->hasFile('user_avatar')) {
            $path = 'public/uploads/profile/';
            $get_image = $request->file('user_avatar');
            $name_image = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $oldImage = $student->user_avatar;
            if ($oldImage && Storage::exists("public/uploads/profile/$oldImage")) {
                Storage::delete("public/uploads/profile/$oldImage");
            }

            $data['user_avatar'] = $new_image;
        }

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $student->update($data);

        return redirect('admin/student/list')->with('success', 'Student successfully updated');
    }

    public function delete($id)
    {
        $student = User::find($id);
        $student->is_delete = 1;
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student successfully deleted ');
    }

    //

}
