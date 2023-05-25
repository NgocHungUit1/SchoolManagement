<?php

/**
 *  TeacherController
 *
 * @category   UserController
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileStudentRequest;
use App\Http\Requests\UserRequest;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * UserController
 *
 * @category UserController
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */

class UserController extends Controller
{
    /**
     * Display the user profile page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $data['getClass'] = ClassModel::find(Auth::user()->class_id);
        $data['getRecord'] = User::find(Auth::user()->id);

        // Check user type for rendering respective view
        if (Auth::user()->user_type == 1) {
            return view('admin.admin.profile', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.profile', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student.profile', $data);
        }
    }

    /**
     * Display the user profile edit page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEdit()
    {
        $data['getRecord'] = User::getUserId(Auth::user()->id);
        $data['getClass'] = ClassModel::getClass();

        // Check user type for rendering respective view
        if (Auth::user()->user_type == 1) {
            return view('admin.admin.profile_edit', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.profile_edit', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student.profile_edit', $data);
        }
    }
    /**
     * Update teacher's profile information.
     *
     * @param UpdateProfileStudentRequest $request Request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileTeacher(UpdateProfileStudentRequest $request)
    {
        $teacher = Auth::user();
        $teacher->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'gender' => $request->gender,
                'date_of_birth' => Carbon::createFromFormat(
                    'd-m-Y',
                    $request->date_of_birth
                )
                    ->toDateTimeString(),
                'mobile_number' => $request->mobile_number,
            ]
        );

        // Update profile picture
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/' . $teacher->user_avatar;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99)
                . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $teacher->user_avatar = $new_image;
        }

        $teacher->save();

        return redirect('teacher/profile')
            ->with('success', 'Teacher successfully updated ');
    }

    /**
     * Update student's profile information.
     *
     * @param UpdateProfileStudentRequest $request Request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileStudent(UpdateProfileStudentRequest $request)
    {
        $student = Auth::user();
        $student->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'gender' => $request->gender,
                'date_of_birth' => Carbon::createFromFormat(
                    'd-m-Y',
                    $request->date_of_birth
                )->toDateTimeString(),
                'mobile_number' => $request->mobile_number,
            ]
        );

        // Update profile picture
        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/' . $student->user_avatar;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) .
                '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $student->user_avatar = $new_image;
        }

        $student->save();

        return redirect('student/profile')
            ->with('success', 'Student edit successfully updated ');
    }

    /**
     * Update admin's profile information.
     *
     * @param UserRequest $request Request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileAdmin(UserRequest $request)
    {
        $id = Auth::user()->id;
        $admin = User::getUserId($id);
        $admin->name = ($request->name);
        $admin->mobile_number = $request->mobile_number;

        $get_image = $request->user_avatar;
        if ($get_image) {
            $path = 'public/uploads/profile/' . $admin->user_avatar;
            $path = 'public/uploads/profile/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) .
                '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $admin->user_avatar = $new_image;
        }
        $admin->save();
        return redirect('admin/admin/profile')
            ->with('success', 'Admin successfully updated profile ');
    }

    /**
     * Update password user profile information.
     *
     * @param UserRequest $request Request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $user = User::getUserId(Auth::user()->id);

        // Validation

        if (Hash::check($request->old_password, $user->password)
            && $request->new_password == $request->confirm_password
        ) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()
                ->with('success', 'Password successfully updated ');
        } else {
            return redirect()->back()
                ->with('error', 'Password  error ');
        }
    }
}
