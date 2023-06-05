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
    public function getAllTeachers(array $params = [])
    {
        return User::getTeacher($params);
    }

    public function createTeacher(array $data)
    {
        $data['teacher_id'] = 'Teacher' . substr(md5(microtime()), rand(0, 26), 5);
        $data['date_of_birth'] = Carbon::createFromFormat(
            'd-m-Y',
            $data['date_of_birth']
        )
            ->toDateTimeString();
        $data['joining_date'] = Carbon::createFromFormat(
            'd-m-Y',
            $data['joining_date']
        )->toDateTimeString();
        $data['password'] = Hash::make($data['password']);
        $data['user_type'] = 2;

        if (!empty($data['user_avatar'])) {
            $path = 'public/uploads/profile/';
            $get_image = $data['user_avatar'];
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
    public function updateTeacher(array $data, $id)
    {
        $teacher = User::findOrFail($id);
        $data['joining_date'] = Carbon::createFromFormat(
            'd-m-Y',
            $data['joining_date']
        )
            ->toDateTimeString();
        $data['date_of_birth'] = Carbon::createFromFormat(
            'd-m-Y',
            $data['date_of_birth']
        )
            ->toDateTimeString();

        if (!empty($data['user_avatar'])) {
            $path = 'public/uploads/profile/';
            $get_image = $data['user_avatar'];
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
        $data['password'] = Hash::make($data['password']);


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
        $teacher->is_delete = 1;
        $teacher->save();
    }
}
