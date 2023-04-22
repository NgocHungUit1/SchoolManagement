<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Profile()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = User::getUserId(Auth::user()->id);
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

    public function updateProfileTeacher(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',

        ],
            [
                'email.unique' => 'Email đã có,xin điền email khác',
            ]
        );

        $teacher = User::getUserId($id);
        $teacher->name = trim($request->name);
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
        $teacher->save();
        return redirect('teacher/profile-edit')->with('success', 'teacher successfully updated ');
    }

    public function updateProfileStudent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'required|unique:users,admission_number,' . $id,

        ],
            [
                'email.unique' => 'Email đã có,xin điền email khác',
                'admission_number.unique' => 'Id student đã có,xin điền IDs khác',
            ]
        );

        $student = User::getUserId($id);
        $student->name = trim($request->name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);

        $student->address = trim($request->address);
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
        $student->save();
        return redirect('student/profile-edit')->with('success', 'teacher successfully updated ');
    }

    public function updateProfileAdmin(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',

        ],
            [
                'email.unique' => 'Email đã có,xin điền email khác',
            ]
        );

        $admin = User::getUserId($id);
        $admin->name = trim($request->name);
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
        $admin->email = trim($request->email);
        $admin->save();
        return redirect('admin/admin/profile-edit')->with('success', 'Admin successfully updated ');
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

}
