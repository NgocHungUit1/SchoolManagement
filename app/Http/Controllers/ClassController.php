<?php

namespace App\Http\Controllers;

use App\Exports\ClassExport;
use App\Http\Requests\ClassRequest;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    function list() {
        $data['getRecord'] = ClassModel::getRecord();
        return view('admin.class.list', $data);
    }

    public function getData()
    {
        $data['data'] = ClassModel::getRecord();
        return $data;
    }

    public function add()
    {
        return view('admin.class.add');
    }

    public function insertClass(ClassRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;
        ClassModel::create($data);
        return redirect('admin/class/list')->with('success', 'Class successfully created ');
    }

    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getClassId($id);

        return view('admin.class.edit', $data);
    }

    public function view($id)
    {

        $data['getRecord'] = ClassModel::getStudent($id);
        $data['getClass'] = ClassModel::find($id);
        return view('admin.class.view', $data);
    }

    public function myClass()
    {
        $data['getRecord'] = ClassModel::getStudent(Auth::user()->class_id);
        $data['getClass'] = ClassModel::find(Auth::user()->class_id);
        return view('student.my_class', $data);
    }

    public function editClass(ClassRequest $request, $id)
    {
        $class = ClassModel::findOrFail($id);
        $data = $request->validated();
        $class->update($data);
        return redirect('admin/class/list')->with('success', 'Class successfully updated ');

    }

    public function delete($id)
    {
        $class = ClassModel::find($id);
        $class->is_delete = 1;
        $class->save();
        return redirect('admin/admin/list')->with('success', 'Class successfully deleted ');
    }

}
