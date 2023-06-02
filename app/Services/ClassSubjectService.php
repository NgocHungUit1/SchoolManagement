<?php

/**
 *  ClassSubjectService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Exports\AssignSubjectExport;
use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

/**
 * ClassSubjectService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class ClassSubjectService
{
    /**
     * Get a list of all class subjects.
     *
     * @return mixed
     */
    public function getList(array $params = [])
    {
        return ClassSubject::getRecord($params);
    }


    /**
     * Get a class subject by ID.
     *
     * @param int $id The ID of the class subject to retrieve.
     *
     * @return mixed
     */
    public function getById($id)
    {
        return ClassSubject::find($id);
    }

    /**
     * Get the assigned subject IDs for a given class ID.
     *
     * @param int $class_id The ID of the class to retrieve assigned subjects for.
     *
     * @return mixed
     */
    public function getByClassId($class_id)
    {
        return ClassSubject::getAssignSubjectId($class_id);
    }

    /**
     * Add one or more class subjects.
     *
     * @param Request $request The request object containing the data to add.
     *
     * @return bool True if the addition was successful, false otherwise.
     */
    public function add($class_id, $subject_ids, $status)
    {
        try {
            if (!empty($subject_ids)) {
                foreach ($subject_ids as $subject_id) {
                    $getAlready = ClassSubject::getAlreadyFirst($class_id, $subject_id);
                    $getAlready ? $getAlready->update(compact('status'))
                        : ClassSubject::create(
                            [
                                'class_id' => $class_id,
                                'subject_id' => $subject_id,
                                'status' => $status,
                                'created_by' => Auth::user()->id,
                            ]
                        );
                }
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error($e);
            throw new Exception('My first Sentry error!');
        }
    }


    /**
     * Update the assigned subjects for a given class ID.
     *
     * @param Request $request The request object containing the data to update.
     *
     * @return bool True if the update was successful, false otherwise.
     */
    public function update($class_id, $subject_ids, $status)
    {
        try {
            ClassSubject::deleteSubject($class_id);
            if (!empty($subject_ids)) {
                foreach ($subject_ids as $subject_id) {
                    $getAlready = ClassSubject
                        ::getAlreadyFirst($class_id, $subject_id);

                    $getAlready ? $getAlready->update(compact('status'))
                        : ClassSubject::create(
                            [
                                'class_id' => $class_id,
                                'subject_id' => $subject_id,
                                'status' => $status,
                                'created_by' => Auth::user()->id,
                            ]
                        );
                }
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error($e);
            throw new Exception('Update class subject error!');
        }
    }


    /**
     * Delete a class subject by ID.
     *
     * @param int $id The ID of the class subject to delete.
     *
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function delete($id)
    {
        $subject = ClassSubject::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return true;
    }
}
