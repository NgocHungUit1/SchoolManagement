<?php

/**
 *  ClassSubjectController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Services\ClassSubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

/**
 * ClassSubjectController
 *
 * @category ClassSubject
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */

class ClassSubjectController extends Controller
{
    /**
     * The ClassSubjectService instance.
     *
     * @var ClassSubjectService $classSubjectService
     */
    private $_classSubjectService;

    /**
     * ClassSubjectController constructor.
     *
     * @param ClassSubjectService $classSubjectService ClassSubjectService
     *
     * @return void
     */
    public function __construct(ClassSubjectService $classSubjectService)
    {
        $this->_classSubjectService = $classSubjectService;
    }

    /**
     * Show the list of assigned subjects to classes.
     *
     * @return Illuminate\Contracts\View\Factory|
     */
    public function list()
    {
        $data['getRecord'] = $this->_classSubjectService->getList();
        return view('admin.assign_subject.list', $data);
    }

    /**
     * Get the data for assigned subjects to classes.
     *
     * @return array The data for assigned subjects to classes.
     */
    public function getData()
    {
        $data['data'] = $this->_classSubjectService->getList();
        return $data;
    }

    /**
     * Show the form to add an assigned subject to a class.
     *
     * @param Request $request The HTTP request.
     *
     * @return void
     */
    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        return view('admin.assign_subject.add', $data);
    }

    /**
     * Show the form to edit an assigned subject to a class.
     *
     * @param int $id The ID of the assigned subject to a class.
     *
     * @return Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $getRecord = $this->_classSubjectService->getById($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectId'] = $this->_classSubjectService
                ->getByClassId($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
        }
        return view('admin.assign_subject.edit', $data);
    }

    /**
     * Assign a subject to a class.
     *
     * @param AssignSubjectClassRequest $request The HTTP request.
     *
     * @return \Illuminate\Http\RedirectResponse The
     */
    public function assignSubject(AssignSubjectClassRequest $request)
    {
        if ($this->_classSubjectService->add($request)) {
            return redirect('admin/assign_subject/list')
                ->with('success', 'subject assign class created successfully  ');
        } else {
            return redirect()->back()
                ->with('error', 'Please select at least one subject.');
        }
    }

    /**
     * Update an assigned subject to a class.
     *
     * @param AssignSubjectClassRequest $request The HTTP request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssignSubjectClassRequest $request)
    {
        if ($this->_classSubjectService->update($request)) {
            return redirect('admin/assign_subject/list')
                ->with('success', 'subject assign class updated successfully  ');
        } else {
            return redirect()->back()
                ->with('error', 'Please select at least one subject.');
        }
    }

    /**
     * Delete an assigned subject to a class.
     *
     * @param int $id The ID of the assigned subject to a class.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($this->_classSubjectService->delete($id)) {
            return redirect('admin/assign_subject/list')
                ->with('success', 'Subject successfully deleted ');
        } else {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
