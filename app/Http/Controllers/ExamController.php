<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\ExamScore;
use App\Models\User;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function insertScore(Request $request)
    {
        return $this->examService->insertScore($request);
    }

    function list(Request $request) {
        $data['getRecord'] = Exam::getRecord();
        return view('admin.exam.list', $data);
    }

    public function getData()
    {
        $data['data'] = Exam::getRecord();
        return $data;
    }

    public function add(Request $request)
    {
        return view('admin.exam.add');
    }

    public function edit($id)
    {

        $getRecord = Exam::find($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
        }
        return view('admin.exam.edit', $data);
    }

    public function addExam(ExamRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;
        Exam::create($data);
        return redirect('admin/exam/list')->with('success', 'Exam Successfully Created ');
    }

    public function update(ExamRequest $request, $id)
    {
        $save = Exam::findOrFail($id);
        $data = $request->validated();
        $save->update($data);
        return redirect('admin/exam/list')->with('success', 'Exam  updated successfully  ');
    }

    public function delete($id)
    {
        $subject = Exam::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/exam/list')->with('success', 'Exam successfully deleted ');
    }

    public function examScore(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::MySubject($request->class_id);
        }

        if (!empty($request->subject_id) && !empty($request->class_id)) {
            $data['getExam'] = ExamSchedule::getExam($request->class_id);
            $data['getStudent'] = User::getStudentClassExam($request->class_id);
        }

        return view('admin.exam.score', $data);
    }

    public function examSchedule(Request $request)
    {
        $result = $this->examService->getExamSchedule($request->exam_id, $request->class_id);

        $data = [
            'getClass' => ClassModel::getClass(),
            'getClassS' => ClassModel::find($request->class_id),
            'getExam' => Exam::getExam(),
            'getRecord' => $result,
        ];

        return view('admin.exam.schedule', $data)->with('success', 'My Time Table Teacher');
    }

    public function examScheduleInsert(Request $request)
    {
        $result = $this->examService->examScheduleInsert($request);
        return $result;
    }

    //student

    public function myExam(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $data['getRecord'] = $this->examService->getMyExam($class_id);

        return view('student.my_exam', $data);
    }

    public function scoreStudent()
    {
        $class_id = Auth::user()->class_id;
        $data['getRecord'] = ExamScore::getRecordStudent($class_id, Auth::user()->id);
        $data['getExam'] = ExamSchedule::getExam($class_id);
        $data['getSubject'] = ClassSubject::getMySubjectTeacher(Auth::user()->class_id);

        return view('student.academic_record', $data);
    }
    //teacher

    public function myExamTeacher(Request $request)
    {
        $user_id = Auth::user()->id;
        $data['getRecord'] = $this->examService->getMyExamTeacher($user_id);

        return view('teacher.my_exam', $data);
    }


    public function examScoreTeacher(Request $request)
    {
        $data['getClass'] = ClassModel::getStudentTeacher(Auth::user()->id);
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::MySubject($request->class_id);
        }

        if (!empty($request->subject_id) && !empty($request->class_id)) {
            $data['getExam'] = ExamSchedule::getExam($request->class_id);
            $data['getStudent'] = User::getStudentClassExam($request->class_id);
        }

        return view('teacher.exam_score', $data);
    }

    public function addScoreByTeacher(Request $request)
    {
        ExamScore::where('class_id', '=', $request->class_id)->where('subject_id', '=', $request->subject_id)->delete();
        $examScores = $request->input('exam_score');
        foreach ($examScores as $studentId => $scores) {
            foreach ($scores as $scoreData) {
                if (!empty($studentId) && !empty($scoreData['exam_id']) && !empty($scoreData['score'])) {

                    ExamScore::create([
                        'exam_id' => $scoreData['exam_id'],
                        'class_id' => $request->input('class_id'),
                        'subject_id' => $request->input('subject_id'),
                        'student_id' => $studentId,
                        'score' => $scoreData['score'],
                        'created_by' => Auth::user()->id,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Exam scores have been saved.');
    }

    public function get_Subject(Request $request)
    {
        $getSubject = ClassSubject::MySubject($request->class_id);
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>" . $value->subject_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    public function get_Subject_Teacher(Request $request)
    {
        $getSubject = ClassTeacher::getSubjectExam($request->class_id, Auth::user()->id);
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>" . $value->subject_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
