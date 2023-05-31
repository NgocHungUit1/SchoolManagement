<?php

/**
 *  StudentController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Requests\InsertStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\StudentService;

/**
 * StudentController
 *
 * @category StudentController
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class StudentController extends Controller
{
    /**
     * ClassTimeTableService instance.
     *
     * @var StudentService
     */
    protected $service;

    /**
     * StudentController constructor.
     *
     * @param StudentService $service StudentService
     *
     * @return void
     */
    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    /**
     * Displays list of all students
     *
     * @return \Illuminate\View\View View instance that renders student list
     */
    public function list()
    {
        $data['getRecord'] = $this->service->getAllStudents();


        return view('admin.student.list', $data);
    }

    /**
     * Get data of all students
     *
     * @return array Array containing all student records
     */
    public function getData()
    {
        $data['data'] = $this->service->getAllStudents();
        return $data;
    }

    /**
     * Display form to add a new student
     *
     * @return \Illuminate\View\View View instance that renders add-student form
     */
    public function add()
    {
        $data['getClass'] = $this->service->getAllClasses();
        return view('admin.student.add', $data);
    }

    /**
     * Display form to edit a student
     *
     * @param int $id ID of student record to edit
     *
     * @return \Illuminate\View\View View instance that renders edit-student form
     */
    public function edit($id)
    {
        $data['getRecord'] = $this->service->getStudentById($id);

        if (!empty($data['getRecord'])) {
            $data['getClass'] = $this->service->getAllClasses();
        } else {
            abort(404);
        }

        return view('admin.student.edit', $data);
    }

    /**
     * Add a new student
     *
     * @param InsertStudentRequest $request Request instance containing form data
     *
     * @return Redirect Redirect response to student list page
     */
    public function addStudent(InsertStudentRequest $request)
    {
        $this->service->createStudent($request);

        return redirect('admin/student/list')
            ->with('success', 'Student successfully created ');
    }

    /**
     * Update an existing student record
     *
     * @param UpdateStudentRequest $request Request instance containing form data
     * @param int                  $id      ID of the student record to update
     *
     * @return Redirect response to student list page
     */
    public function editStudent(UpdateStudentRequest $request, $id)
    {
        $this->service->updateStudent($request, $id);

        return redirect('admin/student/list')
            ->with('success', 'Student successfully updated');
    }

    /**
     * Delete a student record
     *
     * @param int $id ID of the student record to delete
     *
     * @return Redirect response to student list page
     */
    public function delete($id)
    {
        $this->service->deleteStudent($id);

        return redirect('admin/student/list')
            ->with('success', 'Student successfully deleted ');
    }
}
