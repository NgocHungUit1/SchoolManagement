<?php
namespace App\Services;

use App\Http\Requests\InsertStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    public function getAllStudents()
    {
        return User::getStudent();
    }

    public function getStudentById($id)
    {
        return User::getUserId($id);
    }

    public function createStudent(InsertStudentRequest $request)
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
    }

    public function updateStudent(UpdateStudentRequest $request, $id)
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
    }

    public function deleteStudent($id)
    {
        $student = User::find($id);
        $student->is_delete = 1;
        $student->save();
    }

    public function getAllClasses()
    {
        return ClassModel::getClass();
    }
}
