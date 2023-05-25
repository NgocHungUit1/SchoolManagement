<?php

/**
 * TeacherService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * TeacherService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class TeacherService
{
    /**
     * Add a new teacher
     *
     * @param TeacherRequest $request Request instance containing form data
     *
     * @return Redirect Redirect response to teacher list page
     */
    public function createTeacher(TeacherRequest $request)
    {
        $data = $request->validated();
        $data['date_of_birth'] = Carbon::createFromFormat(
            'd-m-Y',
            $request->date_of_birth
        )
            ->toDateTimeString();
        $data['joining_date'] = Carbon::createFromFormat(
            'd-m-Y',
            $request->joining_date
        )->toDateTimeString();
        $data['password'] = Hash::make($request->password);
        $data['user_type'] = 2;

        if ($request->hasFile('user_avatar')) {
            $path = 'public/uploads/profile/';
            $get_image = $request->file('user_avatar');
            $name_image = pathinfo(
                $get_image->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            $new_image = $name_image . rand(0, 99) . '.'
                . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $data['user_avatar'] = $new_image;
        }

        User::create($data);
    }
    /**
     * Update Teacher
     *
     * @param InsertStudentRequest $request Request instance containing form data
     * @param int                  $id      The ID of the users
     *
     * @return Redirect Redirect response to Teacher list page
     */
    public function updateTeacher(UpdateTeacherRequest $request, $id)
    {
        $teacher = User::findOrFail($id);
        $data = $request->validated();
        $data['joining_date'] = Carbon::createFromFormat(
            'd-m-Y',
            $request->joining_date
        )
            ->toDateTimeString();
        $data['date_of_birth'] = Carbon::createFromFormat(
            'd-m-Y',
            $request->date_of_birth
        )
            ->toDateTimeString();

        if ($request->hasFile('user_avatar')) {
            $path = 'public/uploads/profile/';
            $get_image = $request->file('user_avatar');
            $name_image = pathinfo(
                $get_image->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            $new_image = $name_image . rand(0, 99) . '.'
                . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $oldImage = $teacher->user_avatar;
            if ($oldImage && Storage::exists("public/uploads/profile/$oldImage")) {
                Storage::delete("public/uploads/profile/$oldImage");
            }

            $data['user_avatar'] = $new_image;
        }

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $teacher->update($data);
    }
    /**
     * Delete Teacher
     *
     * @param int $id The ID of the users
     *
     * @return Redirect Redirect response to Teacher list page
     */
    public function deleteTeacher($id)
    {
        $teacher = User::find($id);
        if (!empty($teacher)) {
            $teacher->is_delete = 1;
            $teacher->save();
            return redirect('admin/teacher/list')
                ->with('success', 'teacher successfully deleted ');
        } else {
            abort(404);
        }
    }
    /**
     * Display my student of teacher
     *
     * @return \Illuminate\View\View View
     */
    public function getMyStudent()
    {
        $data['getRecord'] = ClassModel::getStudentTeacher(Auth::user()->id);
        return view('teacher.my_student_class', $data);
    }
    /**
     * Display view student of teacher,class
     *
     * @param int $id ID of the Class
     *
     * @return \Illuminate\View\View View
     */
    public function viewStudent($id)
    {
        $data['getRecord'] = ClassModel::getStudent($id);
        $data['getClass'] = ClassModel::find($id);
        return view('admin.class.view', $data);
    }
    /**
     * Display view my Class
     *
     * @return \Illuminate\View\View View
     */
    public function getMyClass()
    {
        $data['getRecord'] = ClassModel::getTeacherClass(Auth::user()->id);
        return view('teacher.my_student_class', $data);
    }
    /**
     * Display view my Student
     *
     * @return \Illuminate\View\View View
     */
    public function getMyStudentList()
    {
        $data['getRecord'] = User::getStudentTeacher(Auth::user()->id);
        return $data;
    }
}
