<?php

namespace App\Http\Controllers;

use App\Exports\SubjectExport;
use App\Http\Requests\SubjectRequest;
use App\Services\SubjectService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    private $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function list()
    {
        $data['getRecord'] = $this->subjectService->getSubjects();
        return view('admin.subject.list', $data);
    }

    public function getData()
    {
        $data['data'] = $this->subjectService->getSubjects();
        return $data;
    }

    public function add()
    {
        return view('admin.subject.add');
    }

    public function insertSubject(SubjectRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;

        $this->subjectService->createSubject($data);

        return redirect('admin/subject/list')->with('success', 'Subject successfully created');
    }


    public function delete($id)
    {
        $this->subjectService->deleteSubject($id);
        return redirect('admin/subject/list')->with('success', 'Subject successfully deleted ');
    }

    public function edit($id)
    {
        $data['getRecord'] = $this->subjectService->getSubjectById($id);

        return view('admin.subject.edit', $data);
    }

    public function editSubject(SubjectRequest $request, $id)
    {
        $data = $request->validated();
        $this->subjectService->updateSubject($id, $data);
        return redirect('admin/subject/list')->with('success', 'Class successfully updated ');

    }

    public function mySubject()
    {
        $data['getRecord'] = $this->subjectService->getMySubjects(Auth::user()->class_id);

        return view('student.my_subject', $data);
    }
}
