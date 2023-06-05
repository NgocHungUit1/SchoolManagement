<?php

/**
 *  SubjectController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Services\SubjectService;
use Illuminate\Support\Facades\Auth;

/**
 * Subject Controller
 *
 * @category CategoryName
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class SubjectController extends Controller
{
    /**
     * The subject service instance.
     *
     * @var SubjectService
     */
    private $_subjectService;

    /**
     * Subject constructor.
     *
     * @param SubjectService $subjectService SubjectService instance
     *
     * @return void
     */
    public function __construct(SubjectService $subjectService)
    {
        $this->_subjectService = $subjectService;
    }

    /**
     * Display a listing of the subject.
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        $data['getRecord'] = $this->_subjectService->getSubjects();

        return view('admin.subject.list', $data);
    }

    /**
     * Get data from the subject.
     *
     * @return array
     */
    public function getData()
    {
        $data['data'] = $this->_subjectService->getSubjects();

        return $data;
    }

    /**
     * Show the form for creating a new subject.
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        return view('admin.subject.add');
    }

    /**
     * Store a newly created subject in storage.
     *
     * @param SubjectRequest $request Request object
     *
     * @return mixed Result of the insert operation
     */
    public function insertSubject(SubjectRequest $request)
    {
        $data = $request->validated();
        $this->_subjectService->createSubject($data);
        return view('admin.subject.list', $data);
    }

    /**
     * Remove the specified subject from storage.
     *
     * @param int $id Subject ID
     *
     * @return mixed Result of the insert operation
     */
    public function delete($id)
    {
        $this->_subjectService->deleteSubject($id);

        return redirect('admin/subject/list')
            ->with('success', 'Subject successfully deleted ');
    }

    /**
     * Show the form for editing the specified subject.
     *
     * @param int $id Subject ID
     *
     * @return mixed Result of the insert operation
     */
    public function edit($id)
    {
        $data['getRecord'] = $this->_subjectService->getSubjectById($id);

        return view('admin.subject.edit', $data);
    }

    /**
     * Update the specified subject in storage.
     *
     * @param SubjectRequest $request Request object
     * @param int            $id      Subject ID
     *
     * @return mixed Result of the insert operation
     */
    public function editSubject(SubjectRequest $request, $id)
    {
        $data = $request->validated();
        $this->_subjectService->updateSubject($id, $data);

        return redirect('admin/subject/list')
            ->with('success', 'Subject successfully updated ');
    }

    /**
     * Display a listing of the user's enrolled subjects.
     *
     * @return \Illuminate\View\View
     */
    public function mySubject()
    {
        $data['getRecord'] = $this->_subjectService
            ->getMySubjects(Auth::user()->class_id);

        return view('student.my_subject', $data);
    }
}
