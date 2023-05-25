<?php

/**
 *  ClassTeacherController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\AssignTeacherRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Subject;
use App\Models\User;
use App\Services\ClassTeacherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ClassTeacherController
 *
 * @category ClassTeacher
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */

class ClassTeacherController extends Controller
{
    /**
     * The ClassTeacherService instance.
     *
     * @var ClassTeacherService $classTeacherService
     */
    protected $classTeacherService;

    /**
     * ClassTeacherController constructor.
     *
     * @param ClassTeacherService $classTeacherService ClassTeacherService
     *
     * @return void
     */
    public function __construct(ClassTeacherService $classTeacherService)
    {
        $this->classTeacherService = $classTeacherService;
    }

    /**
     * Show the list of assigned teacher to classes.
     *
     * @return Illuminate\Contracts\View\Factory|
     */
    function list()
    {
        $data['getRecord'] = $this->classTeacherService->getList();
        return view('admin.assign_class_teacher.list', $data);
    }

    /**
     * Get the data for assigned teacher to classes.
     *
     * @return array The data for assigned teacher to classes.
     */
    public function getData()
    {
        $data['data'] = ClassTeacher::getRecord();

        return $data;
    }

    /**
     * Shows the add teacher form.
     *
     * @return mixed The add teacher form
     */
    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacher();

        return view('admin.assign_class_teacher.add', $data);
    }

    /**
     * Assign a teacher to a class.
     *
     * @param AssignTeacherRequest $request The HTTP request.
     *
     * @return \Illuminate\Http\RedirectResponse The
     */
    public function assignTeacherClass(AssignTeacherRequest $request)
    {
        $result = $this->classTeacherService->add($request->validated());

        return redirect('admin/assign_class_teacher/list')
            ->with($result['status'], $result['message']);
    }

    /**
     * Show the form to edit an assigned teacher to a class.
     *
     * @param int $id The ID of the assigned teacher to a class.
     *
     * @return Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $getRecord = ClassTeacher::find($id);
        $data['getSubject'] = Subject::getSubject();
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacher();
        }

        return view('admin.assign_class_teacher.edit', $data);
    }

    /**
     * Update an assigned teacher to a class.
     *
     * @param AssignTeacherRequest $request The HTTP request.
     * @param int                  $id      The ID of the class subject to delete.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssignTeacherRequest $request, $id)
    {
        $result = $this->classTeacherService->update($id, $request->validated());

        return redirect('admin/assign_class_teacher/list')
            ->with($result['status'], $result['message']);
    }

    /**
     * Delete an assigned teacher to a class.
     *
     * @param int $id The ID of the assigned teacher to a class.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $result = $this->classTeacherService->delete($id);

        return redirect('admin/assign_class_teacher/list')
            ->with($result['status'], $result['message']);
    }

    /**
     * My subject of class
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mySubjectClass()
    {
        $data['getRecord'] = $this->classTeacherService
            ->getMySubjectClass(Auth::user()->id);

        return view('teacher.my_subject_class', $data);
    }

    /**
     * Get subject of class
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getSubject(Request $request)
    {

        $getSubject = ClassSubject::MySubject($request->class_id);
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>"
                . $value->subject_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    /**
     * Get teacher of subject
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getTeacher(Request $request)
    {

        $get_Teacher = User::SubjectTeacher($request->subject_id);
        $html = "<option value=''> Select </option>";
        foreach ($get_Teacher as $value) {
            $html .= "<option value='" . $value->id . "'>"
                . $value->teacher_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
