<?php

namespace App\Http\Controllers;

use App\Exports\ClassExport;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    function list() {
        // $data['getStudent'] = ClassModel::getStudent();
        // dd($data);
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

    public function insertClass(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);
        $class = new ClassModel();
        $class->name = $request->name;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;
        $class->save();
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

    public function editClass(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
        ]);
        $class = ClassModel::getClassId($id);
        $class->name = $request->name;
        $class->status = $request->status;
        $class->save();
        return redirect('admin/class/list')->with('success', 'Class successfully updated ');

    }

    public function delete($id)
    {
        $class = ClassModel::getClassId($id);
        $class->is_delete = 1;
        $class->save();
        return redirect('admin/admin/list')->with('success', 'Class successfully deleted ');
    }
    public function export()
    {
        return Excel::download(new ClassExport, 'class.xlsx');
    }

}
