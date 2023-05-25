<?php

/**
 *  TeacherController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use App\Services\TeacherService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * TeacherController
 *
 * @category TeacherController
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */

class TeacherController extends Controller
{
    /**
     * ClassTimeTableService instance.
     *
     * @var TeacherService
     */
    protected $service;
    /**
     * TeacherController constructor.
     *
     * @param TeacherService $service TeacherService
     *
     * @return void
     */
    public function __construct(TeacherService $service)
    {
        $this->service = $service;
    }
    /**
     * Displays list of all Teacher
     *
     * @return \Illuminate\View\View View instance that renders Teacher list
     */
    function list()
    {
        $data['getRecord'] = User::getTeacher();
        return view('admin.teacher.list', $data);
    }

    /**
     * Get data of all Teacher
     *
     * @return array Array containing all Teacher records
     */
    public function getData()
    {
        $data['data'] = User::getTeacher();

        return $data;
    }

    /**
     * Display form to add a new Teacher
     *
     * @return \Illuminate\View\View View instance that renders add-Teacher form
     */
    public function add()
    {

        $data['getSubject'] = Subject::getSubject();
        return view('admin.teacher.add', $data);
    }

    /**
     * Display form to edit a Teacher
     *
     * @param int $id ID of Teacher record to edit
     *
     * @return \Illuminate\View\View View instance that renders edit-Teacher form
     */
    public function edit($id)
    {

        $data['getRecord'] = User::find($id);
        if (!empty($data['getRecord'])) {
            $data['getSubject'] = Subject::getSubject();
        } else {
            abort(404);
        }

        return view('admin.teacher.edit', $data);
    }

    /**
     * Add a new Teacher
     *
     * @param TeacherRequest $request Request instance containing form data
     *
     * @return Redirect Redirect response to Teacher list page
     */
    public function addTeacher(TeacherRequest $request)
    {
        $this->service->createTeacher($request);

        return redirect('admin/teacher/list')
            ->with('success', 'Teacher successfully created');
    }

    /**
     * Update an existing Teacher record
     *
     * @param UpdateTeacherRequest $request Request instance containing form data
     * @param int                  $id      ID of the Teacher record to update
     *
     * @return Redirect response to Teacher list page
     */
    public function editTeacher(UpdateTeacherRequest $request, $id)
    {
        $this->service->updateTeacher($request, $id);
        return redirect('admin/teacher/list')
            ->with('success', 'Teacher successfully updated');
    }
    /**
     * Delete a Teacher record
     *
     * @param int $id ID of the Teacher record to delete
     *
     * @return Redirect response to Teacher list page
     */
    public function delete($id)
    {
        return $this->service->deleteTeacher($id);
    }
    /**
     * Display my student of teacher
     *
     * @return \Illuminate\View\View View
     */
    public function myStudent()
    {
        return $this->service->getMyStudent();
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
        return $this->service->viewStudent($id);
    }
    /**
     * Display view my Class
     *
     * @return \Illuminate\View\View View
     */
    public function getClass()
    {
        return $this->service->getMyClass();
    }
    /**
     * Display view my Student
     *
     * @return \Illuminate\View\View View
     */
    public function getStudent()
    {
        return $this->service->getMyStudentList();
    }
}
