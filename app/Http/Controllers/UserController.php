<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UpdateProfileStudentRequest;
use App\Http\Requests\UserRequest;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Profile()
    {
        $data['getClass'] = ClassModel::find(Auth::user()->class_id);
        $data['getRecord'] = User::find(Auth::user()->id);
        if (Auth::user()->user_type == 1) {
            return view('admin.admin.profile', $data);
        }
        if (Auth::user()->user_type == 2) {
            return view('teacher.profile', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student.profile', $data);
        }
    }
    public function profileEdit()
    {
        $data['getRecord'] = User::getUserId(Auth::user()->id);
        $data['getClass'] = ClassModel::getClass();
        if (Auth::user()->user_type == 1) {
            return view('admin.admin.profile_edit', $data);
        }
        if (Auth::user()->user_type == 2) {
            return view('teacher.profile_edit', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student.profile_edit', $data);
        }

    }

    public function updateProfileTeacher(UpdateProfileStudentRequest $request)
    {
        $id = Auth::user()->id;
        $teacher = User::getUserId($id);
        $teacher->name = ($request->name);
        $teacher->address = ($request->address);
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
        $teacher->save();
        return redirect('teacher/profile')->with('success', 'teacher successfully updated ');
    }

    public function updateProfileStudent(UpdateProfileStudentRequest $request)
    {
        $id = Auth::user()->id;
        $student = User::getUserId($id);
        $student->address = ($request->address);
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
        $student->save();
        return redirect('student/profile')->with('success', 'Student edit successfully updated ');
    }

    public function updateProfileAdmin(UserRequest $request)
    {
        $id = Auth::user()->id;
        $admin = User::getUserId($id);
        $admin->name = ($request->name);
        $admin->mobile_number = $request->mobile_number;
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/' . $admin->user_avatar;
            // if (file_exists($path)) {
            //     unlink($path);
            // }
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $admin->user_avatar = $new_image;
        }
        $admin->save();
        return redirect('admin/admin/profile')->with('success', 'Admin successfully updated profile ');
    }

    public function updatePassword(Request $request)
    {

        $user = User::getUserId(Auth::user()->id);

        # Validation

        if (Hash::check($request->old_password, $user->password) && $request->new_password == $request->confirm_password) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password successfully updated ');
        } else {
            return redirect()->back()->with('error', 'Password  error ');

        }

    }

    public function export()
    {
        return (new UsersExport)->download('users.xlsx');
    }

}
