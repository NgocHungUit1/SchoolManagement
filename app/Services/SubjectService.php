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
    public function getSubjects()
    {
        return Subject::getRecord();
    }
    /**
     * Add a new subject
     *
     * @param SubjectRequest $request Request instance containing form data
     *
     * @return Redirect Redirect response to subject list page
     */
    public function createSubject(SubjectRequest $request)
    {
        Log::info('createSubject request', ['data' => $request->all()]);

        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;

        try {
            $subject = Subject::create($data);
            Log::info('createSubject success', ['subject_id' => $subject->id]);
            return redirect('admin/subject/list')
                ->with('success', 'Subject successfully created ');
        } catch (\Exception $e) {
            Log::error('createSubject error', ['message' => $e->getMessage()]);
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Unable to create subject']);
        }
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
        $subject = Subject::getSubjectId($id);
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
        return Subject::getSubjectId($id);
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
        return ClassSubject::getMySubjectTeacher($class_id);
    }
}
