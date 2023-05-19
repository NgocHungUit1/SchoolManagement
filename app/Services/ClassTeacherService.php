<?php
namespace App\Services;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClassTeacherService
{
    public function getList()
    {
        return ClassTeacher::getRecord();
    }

    public function add($data)
    {
        $teacher_id = $data['teacher_id'];
        $getAlreadyTeacher = ClassTeacher::getAlreadyTeacher($data['class_id'], $data['subject_id']);

        if (!empty($getAlreadyTeacher)) {
            // Nếu đã có giáo viên dạy môn học cho lớp học đó rồi thì return với thông báo
            if ($getAlreadyTeacher->teacher_id == $teacher_id) {
                // Trường hợp giáo viên đã được phân công dạy môn học cho lớp học đó rồi
                return ['status' => 'warning', 'message' => 'Teacher Assigned already exist'];
            } else {
                // Trường hợp môn học và lớp học đã được phân công cho một giáo viên khác
                return ['status' => 'warning', 'message' => 'Subject and Class already assigned to another teacher'];
            }
        } else {
            // Nếu chưa có giáo viên dạy môn học cho lớp học đó thì tiến hành phân công
            $data['created_by'] = Auth::user()->id;
            ClassTeacher::create($data);

            return ['status' => 'success', 'message' => 'Class Assigned Successfully'];
        }
    }

    public function update($id, $data)
    {
        $teacher_id = $data['teacher_id'];
        $getAlreadyTeacher = ClassTeacher::getAlreadyTeacher($data['class_id'], $data['subject_id']);
        if (!empty($getAlreadyTeacher)) {
            // Nếu đã có giáo viên dạy môn học cho lớp học đó rồi thì return với thông báo
            if ($getAlreadyTeacher->teacher_id == $teacher_id) {
                // Trường hợp giáo viên đã được phân công dạy môn học cho lớp học đó rồi
                return ['status' => 'warning', 'message' => 'Teacher Assigned already exist'];
            } else {
                // Trường hợp môn học và lớp học đã được phân công cho một giáo viên khác
                return ['status' => 'warning', 'message' => 'Subject and Class already assigned to another teacher'];
            }
        } else {
            $save = ClassTeacher::findOrFail($id);
            $save->update($data);

            return ['status' => 'success', 'message' => 'Assign Class Teacher Updated Successfully'];
        }
    }

    public function delete($id)
    {
        $subject = ClassTeacher::find($id);
        $subject->is_delete = 1;
        $subject->save();

        return ['status' => 'success', 'message' => 'Class Teacher successfully deleted'];
    }

    public function getMySubjectClass($user_id)
    {
        return ClassTeacher::getMyClassSubject($user_id);
    }
}
