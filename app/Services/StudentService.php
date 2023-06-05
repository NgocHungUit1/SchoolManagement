<?php

/**
 *  StudentService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Http\Requests\InsertStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * StudentService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class StudentService
{
    /**
     * StudentService::getAllStudents()
     *
     * Gets data for all student .
     *
     * @return array
     */
    public function getAllStudents(array $params = [])
    {
        return User::getStudent($params);
    }

    /**
     * Gets one student .
     *
     * @param int $id The ID of the User
     *
     * @return array
     */
    public function getStudentById($id)
    {
        return User::getUserId($id);
    }

    /**
     * Add a new student
     *
     * @param InsertStudentRequest $request Request instance containing form data
     *
     * @return Redirect Redirect response to student list page
     */
    public function createStudent(array $data)
    {
        $data['admission_number'] = 'Student -' . substr(md5(microtime()), rand(0, 26), 5);
        $data['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $data['date_of_birth'])
            ->toDateTimeString();
        $data['password'] = Hash::make($data['password']);
        $data['user_type'] = 3;

        if (!empty($data['user_avatar'])) {
            $path = 'public/uploads/profile/';
            $get_image = $data['user_avatar'];
            $name_image = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $data['user_avatar'] = $new_image;
        }

        User::create($data);
    }


    /**
     * Update student
     *
     * @param InsertStudentRequest $request Request instance containing form data
     * @param int                  $id      The ID of the users
     *
     * @return Redirect Redirect response to student list page
     */
    public function updateStudent(array $data, $id)
    {
        $student = User::findOrFail($id);

        if (isset($data['date_of_birth'])) {
            $data['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $data['date_of_birth'])->toDateTimeString();
        }

        if (isset($data['user_avatar'])) {
            $path = 'public/uploads/profile/';
            $get_image = $data['user_avatar'];
            $name_image = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $oldImage = $student->user_avatar;
            if ($oldImage && Storage::exists("public/uploads/profile/$oldImage")) {
                Storage::delete("public/uploads/profile/$oldImage");
            }

            $data['user_avatar'] = $new_image;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $student->update($data);
    }
    /**
     * Delete student
     *
     * @param int $id The ID of the users
     *
     * @return Redirect Redirect response to student list page
     */
    public function deleteStudent($id)
    {
        $student = User::find($id);
        $student->is_delete = 1;
        $student->save();
    }
    /**
     * Get All Classes student
     *
     * @return Redirect Redirect response to student list page
     */
    public function getAllClasses()
    {
        return ClassModel::getClass();
    }
}
