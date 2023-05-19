<?php

namespace App\Services;

use App\Exports\AssignSubjectExport;
use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ClassSubjectService
{
    public function getList()
    {
        return ClassSubject::getRecord();
    }

    public function getById($id)
    {
        return ClassSubject::find($id);
    }

    public function getByClassId($class_id)
    {
        return ClassSubject::getAssignSubjectId($class_id);
    }

    public function add($request)
    {
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlready = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                $status = $request->status;

                $getAlready ? $getAlready->update(compact('status')) : ClassSubject::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $subject_id,
                    'status' => $status,
                    'created_by' => Auth::user()->id,
                ]);
            }
            return true;
        } else {
            return false;
        }
    }

    public function update($request)
    {
        ClassSubject::deleteSubject($request->class_id);
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $getAlready = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                $status = $request->status;

                $getAlready ? $getAlready->update(compact('status')) : ClassSubject::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $subject_id,
                    'status' => $status,
                    'created_by' => Auth::user()->id,
                ]);
            }
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $subject = ClassSubject::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return true;
    }
}
