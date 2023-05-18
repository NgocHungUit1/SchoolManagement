<?php

namespace App\Http\Controllers;

use App\Exports\SubjectExport;
use App\Http\Requests\SubjectRequest;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{

    function list() {
        $data['getRecord'] = Subject::getRecord();
        return view('admin.subject.list', $data);
    }

    public function getData()
    {
        $data['data'] = Subject::getRecord();
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

        Subject::create($data);

        return redirect('admin/subject/list')->with('success', 'Subject successfully created');
    }


    public function delete($id)
    {
        $subject = Subject::getSubjectId($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Subject successfully deleted ');
    }

    public function edit($id)
    {
        $data['getRecord'] = Subject::getSubjectId($id);

        return view('admin.subject.edit', $data);
    }

    public function editSubject(SubjectRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $data = $request->validated();
        $subject->update($data);
        return redirect('admin/subject/list')->with('success', 'Class successfully updated ');

    }

    public function mySubject()
    {
        $data['getRecord'] = ClassSubject::getMySubjectTeacher(Auth::user()->class_id);

        return view('student.my_subject', $data);
    }

}
