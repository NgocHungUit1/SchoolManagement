<?php

/**
 *  ClassTeacherService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */


namespace App\Services;

use App\Models\ClassTeacher;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * ClassTeacherService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class ClassTeacherService
{
    /**
     * ClassTeacherService::getData()
     *
     * Gets data for all teacher classes.
     *
     * @return array
     */
    public function getList()
    {
        return ClassTeacher::getRecord();
    }

    /**
     * ClassTeacherService::add()
     *
     * Displays the form to add a new teacher class subject.
     *
     * @param $data The ID of the class to edit.
     *
     * @return \Illuminate\View\View
     */
    public function add($data)
    {
        try {
            $teacher_id = $data['teacher_id'];
            $getAlreadyTeacher = ClassTeacher::getAlreadyTeacher(
                $data['class_id'],
                $data['subject_id']
            );
            if (!empty($getAlreadyTeacher)) {
                // Nếu đã có giáo viên dạy môn học cho lớp học đó
                if ($getAlreadyTeacher->teacher_id == $teacher_id) {
                    // giáo viên đã được phân công dạy môn học cho lớp học đó rồi
                    return ['status' => 'warning', 'message'
                    => 'Teacher Assigned already exist'];
                } else {
                    //môn học và lớp học đã được phân công cho một giáo viên khác
                    return ['status' => 'warning', 'message'
                    => 'Subject and Class already assigned to another teacher'];
                }
            } else {
                $data['created_by'] = Auth::user()->id;
                ClassTeacher::create($data);

                return ['status' => 'success', 'message'
                => 'Class Assigned Successfully'];
            }
        } catch (\Exception $e) {
            Log::error($e); // Ghi lỗi vào log
            throw new Exception('error!');
        }
    }

    /**
     * ClassService::editClass()
     *
     * Updates a class with new information.
     *
     * @param int $id   the ID of the class to update.
     * @param $data data tacher.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, $data)
    {
        try {
            $teacher_id = $data['teacher_id'];
            $getAlreadyTeacher = ClassTeacher::getAlreadyTeacher(
                $data['class_id'],
                $data['subject_id']
            );
            if (!empty($getAlreadyTeacher)) {
                // Nếu đã có giáo viên dạy môn học cho lớp học đó rồi
                if ($getAlreadyTeacher->teacher_id == $teacher_id) {
                    //giáo viên đã được phân công dạy môn học cho lớp học đó rồi
                    return ['status' => 'warning', 'message'
                    => 'Teacher Assigned already exist'];
                } else {
                    //môn học và lớp học đã được phân công cho một giáo viên khác
                    return ['status' => 'warning', 'message'
                    => 'Subject and Class already assigned to another teacher'];
                }
            } else {
                $save = ClassTeacher::findOrFail($id);
                $save->update($data);

                return ['status' => 'success', 'message'
                => 'Assign Class Teacher Updated Successfully'];
            }
        } catch (\Exception $e) {
            Log::error($e); // Ghi lỗi vào log
            throw new Exception('error!');
        }
    }

    /**
     * ClassService::delete()
     *
     * Deletes a teacher class from the database.
     *
     * @param int $id The ID of the ClassTeacher to delete.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $subject = ClassTeacher::find($id);
        $subject->is_delete = 1;
        $subject->save();

        return ['status' => 'success', 'message'
        => 'Class Teacher successfully deleted'];
    }

    /**
     * ClassService::delete()
     *
     * Deletes a teacher class from the database.
     *
     * @param int $user_id The ID of the teacher.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getMySubjectClass($user_id)
    {
        return ClassTeacher::getMyClassSubject($user_id);
    }
}
