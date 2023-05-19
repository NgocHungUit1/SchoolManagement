<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Http\Requests\ExamRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\ClassTeacher;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\ExamScore;
use App\Models\Subject;
use App\Models\User;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


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

    function list(Request $request)
    {
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
        $getExam = ExamSchedule::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimeTable = ExamSchedule::getExamTimeTable($value->exam_id, $class_id);

            $resultS = array();
            foreach ($getExamTimeTable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }

        $data['getRecord'] = $result;

        return view('student.my_exam', $data);
    }

    public function scoreStudent()
    {
        $class_id = Auth::user()->class_id;
        $data['getRecord'] = ExamScore::getRecordStudent($class_id, Auth::user()->id);
        $data['getExam'] = ExamSchedule::getExam($class_id);
        $data['getSubject'] = ClassSubject::getMySubjectTeacher(Auth::user()->class_id);

        // dd($data);

        return view('student.academic_record', $data);
    }
    //teacher
    public function myExamTeacher(Request $request)
    {
        $result = array();
        $getClass = ClassTeacher::getMyClassTeacher(Auth::user()->id);
        foreach ($getClass as $class) {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $getExam = ExamSchedule::getExamTeacher($class->class_id, $class->subject_id);
            $examArray = array();
            foreach ($getExam as $exam) {
                $dataE = array();
                $dataE['name'] = $exam->exam_name;
                $getExamTimeTable = ExamSchedule::getExamTimeTableTeacher($exam->exam_id, $class->class_id, $class->subject_id);
                $subjectArray = array();
                foreach ($getExamTimeTable as $valueS) {
                    $dataS = array();
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_mark'] = $valueS->full_mark;
                    $dataS['passing_mark'] = $valueS->passing_mark;
                    $subjectArray[] = $dataS;
                }
                $dataE['subject'] = $subjectArray;
                $examArray[] = $dataE;
            }
            $dataC['exam'] = $examArray;
            $result[] = $dataC;
        }
        $data['getRecord'] = $result;

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
