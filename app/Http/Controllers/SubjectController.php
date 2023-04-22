<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{

    function list() {
        $data['getRecord'] = Subject::getRecord();
        return view('admin.subject.list', $data);
    }

    public function add()
    {
        return view('admin.subject.add');
    }

    public function insertSubject(Request $request)
    {
        $subject = new Subject();
        $subject->name = trim($request->name);
        $subject->status = trim($request->status);
        $subject->type = trim($request->type);
        $subject->created_by = Auth::user()->id;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Subject successfully created ');
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

    public function editSubject(Request $request, $id)
    {
        $subject = Subject::getSubjectId($id);
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->type = $request->type;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Class successfully updated ');

    }
    public function mySubject()
    {
        $data['getRecord'] = ClassSubject::MySubject(Auth::user()->class_id);
        return view('student.my_subject', $data);
    }

}
