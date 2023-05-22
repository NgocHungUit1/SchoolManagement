<?php

namespace App\Services;

use App\Http\Requests\SubjectRequest;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubjectService
{
    public function getSubjects()
    {
        return Subject::getRecord();
    }

    public function createSubject(SubjectRequest $request)
    {
        Log::info('createSubject request', ['data' => $request->all()]);

        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;

        try {
            $subject = Subject::create($data);
            Log::info('createSubject success', ['subject_id' => $subject->id]);
            return redirect('admin/subject/list')->with('success', 'Subject successfully created ');
        } catch (\Exception $e) {
            Log::error('createSubject error', ['message' => $e->getMessage()]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Unable to create subject']);
        }
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
