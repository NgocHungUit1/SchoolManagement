<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Services\ClassSubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClassSubjectController extends Controller
{
    private $classSubjectService;

    public function __construct(ClassSubjectService $classSubjectService)
    {
        $this->classSubjectService = $classSubjectService;
    }

    public function list()
    {
        $data['getRecord'] = $this->classSubjectService->getList();
        return view('admin.assign_subject.list', $data);
    }

    public function getData()
    {
        $data['data'] = $this->classSubjectService->getList();
        return $data;
    }

    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        return view('admin.assign_subject.add', $data);
    }

    public function edit($id)
    {
        $getRecord = $this->classSubjectService->getById($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectId'] = $this->classSubjectService->getByClassId($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
        }
        return view('admin.assign_subject.edit', $data);
    }

    public function assignSubject(AssignSubjectClassRequest $request)
    {
        if ($this->classSubjectService->add($request)) {
            return redirect('admin/assign_subject/list')->with('success', 'subject assign class created successfully  ');
        } else {
            return redirect()->back()->with('error', 'Please select at least one subject.');
        }
    }

    public function update(AssignSubjectClassRequest $request)
    {
        if ($this->classSubjectService->update($request)) {
            return redirect('admin/assign_subject/list')->with('success', 'subject assign class updated successfully  ');
        } else {
            return redirect()->back()->with('error', 'Please select at least one subject.');
        }
    }

    public function delete($id)
    {
        if ($this->classSubjectService->delete($id)) {
            return redirect('admin/assign_subject/list')->with('success', 'Subject successfully deleted ');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
