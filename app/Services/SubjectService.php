<?php

namespace App\Services;

use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SubjectService
{
    public function getSubjects()
    {
        return Subject::getRecord();
    }

    public function createSubject(array $data)
    {
        $data['created_by'] = Auth::user()->id;
        Subject::create($data);
    }

    public function deleteSubject($id)
    {
        $subject = Subject::getSubjectId($id);
        $subject->is_delete = 1;
        $subject->save();
    }

    public function getSubjectById($id)
    {
        return Subject::getSubjectId($id);
    }

    public function updateSubject($id, array $data)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($data);
    }

    public function getMySubjects($class_id)
    {
        return ClassSubject::getMySubjectTeacher($class_id);
    }
}
