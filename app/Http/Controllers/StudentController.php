<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Requests\InsertStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\StudentService;

class StudentController extends Controller
{
    protected $service;

    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        $data['getRecord'] = $this->service->getAllStudents();

        return view('admin.student.list', $data);
    }

    public function getData()
    {
        $data['data'] = $this->service->getAllStudents();
        return $data;
    }

    public function add()
    {
        $data['getClass'] = $this->service->getAllClasses();
        return view('admin.student.add', $data);
    }

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

    public function addStudent(InsertStudentRequest $request)
    {
        $this->service->createStudent($request);

        return redirect('admin/student/list')->with('success', 'Student successfully created ');
    }

    public function editStudent(UpdateStudentRequest $request, $id)
    {
        $this->service->updateStudent($request, $id);

        return redirect('admin/student/list')->with('success', 'Student successfully updated');
    }

    public function delete($id)
    {
        $this->service->deleteStudent($id);

        return redirect('admin/student/list')->with('success', 'Student successfully deleted ');
    }
}
