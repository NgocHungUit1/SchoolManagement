<?php

/**
 *  SubjectService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Http\Requests\SubjectRequest;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

class SubjectService
{
    /**
     * Gets data for all subject .
     *
     * @return array
     */
    public function getSubjects(array $params = [])
    {
        return Subject::getRecord($params);
    }
    /**
     * Add a new subject
     *
     * @param SubjectRequest $request Request instance containing form data
     *
     * @return Redirect Redirect response to subject list page
     */
    public function createSubject(array $data)
    {
        $data['created_by'] = Auth::user()->id;
        Subject::create($data);
    }
    /**
     * Delete subject
     *
     * @param int $id The ID of the subject
     *
     * @return Redirect Redirect response to subject list page
     */
    public function deleteSubject($id)
    {
        $subject = Subject::find($id);
        $subject->is_delete = 1;
        $subject->save();
    }
    /**
     * Get Subject By Id
     *
     * @param int $id The ID of the subject
     *
     * @return Redirect Redirect response to subject list page
     */
    public function getSubjectById($id)
    {
        return Subject::find($id);
    }
    /**
     * Update Subject By Id
     *
     * @param int $id   The ID of the subject
     * @param $data The ID of the subject
     *
     * @return Redirect Redirect response to subject list page
     */
    public function updateSubject($id, array $data)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($data);
    }

    /**
     * Get My Subjects of class
     *
     * @param int $class_id The ID of the class
     *
     * @return Redirect Redirect response to subject list page
     */
    public function getMySubjects($class_id)
    {
        return ClassTeacher::getMySubjectTeacher($class_id);
    }
}
