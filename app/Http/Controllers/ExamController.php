<?php

/**
 *  ExamController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

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

/**
 * ExamController
 *
 * @category ExamController
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */

class ExamController extends Controller
{
    /**
     * ExamService instance.
     *
     * @var ExamService
     */
    protected $examService;

    /**
     * ExamController constructor.
     *
     * @param ExamService $examService ExamService
     *
     * @return void
     */
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    /**
     * Insert score student.
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\View\View
     */
    public function insertScore(Request $request)
    {
        return $this->examService->insertScore($request);
    }

    /**
     * List Exam.
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\View\View
     */
    function list(Request $request)
    {
        $data['getRecord'] = Exam::getRecord();
        return view('admin.exam.list', $data);
    }

    /**
     * List Exam.
     *
     * @return \Illuminate\View\View
     */
    public function getData()
    {
        $data['data'] = Exam::getRecord();
        return $data;
    }

    /**
     * Display add Exam form.
     *
     * @param Request $request The HTTP request.
     *
     * @return \Illuminate\View\View
     */
    public function add(Request $request)
    {
        return view('admin.exam.add');
    }

    /**
     * Shows the edit Exam form.
     *
     * @param int $id Exam ID
     *
     * @return mixed The edit Exam form
     */
    public function edit($id)
    {
        $getRecord = Exam::find($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
        }
        return view('admin.exam.edit', $data);
    }

    /**
     * Inserts a new Exam .
     *
     * @param ExamRequest $request Request object
     *
     * @return mixed Result of the insert operation
     */
    public function addExam(ExamRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;
        Exam::create($data);
        return redirect('admin/exam/list')
            ->with('success', 'Exam Successfully Created ');
    }

    /**
     * Updates the data of a Exam.
     *
     * @param ExamRequest $request Request object
     * @param int         $id      Exam ID
     *
     * @return mixed Result of the update operation
     */
    public function update(ExamRequest $request, $id)
    {
        $save = Exam::findOrFail($id);
        $data = $request->validated();
        $save->update($data);
        return redirect('admin/exam/list')
            ->with('success', 'Exam  updated successfully  ');
    }

    /**
     * Deletes a class.
     *
     * @param int $id Class ID
     *
     * @return mixed Result of the delete operation
     */
    public function delete($id)
    {
        $subject = Exam::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/exam/list')
            ->with('success', 'Exam successfully deleted ');
    }

    /**
     * Display Exam score.
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
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

    /**
     * Display Exam score.
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function academic(Request $request)
    {
        $data['getRecord'] = ClassModel::getClass();
        return view('admin.exam.academic', $data);
    }

    /**
     * AcademicRecord a class.
     *
     * @param int $id Class ID
     *
     * @return mixed Result of the AcademicRecord operation
     */
    public function academicRecord($id)
    {
        $data['getClass'] = ClassModel::find($id);
        $data['getStudent'] = User::getStudentClassExam($id);
        $data['getSubject'] = ClassSubject::MySubject($id);
        $data['getScore'] = ExamScore::getAcademicRecord($id);

        foreach ($data['getStudent'] as $student) {
            $scored_subjects = []; // Khởi tạo một mảng tạm thời để lưu trữ các subject_id đã được chấm điểm của học sinh
            $total_score = 0;
            $total_subjects_scored = 0;

            foreach ($data['getSubject'] as $subject) {
                $scores = $data['getScore']->where('subject_id', $subject->subject_id)
                    ->where('student_id', $student->id)
                    ->first()->avage_score ?? '';
                if (!empty($scores)) {
                    $total_score += $scores;
                    $total_subjects_scored++;

                    // Lưu trữ subject_id của môn đã được chấm điểm vào mảng tạm thời
                    $scored_subjects[] = $subject->subject_id;
                }
            }

            // Tính giá trị $all_subjects dựa trên số lượng phần tử trong mảng getSubject
            $all_subjects = count($data['getSubject']);

            // Kiểm tra xem số môn đã được chấm điểm của học sinh có bằng tổng số môn hay không
            if ($total_subjects_scored == $all_subjects) {
                $average = number_format($total_score / $all_subjects, 2);
                // Cập nhật giá trị avagescore của học sinh hiện tại trong bảng User
                $user = User::find($student->id);
                $user->score = $average;
                $user->save();
            }
        }

        return view('admin.exam.academic_record', $data);
    }


    /**
     * Display exam Schedule
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function examSchedule(Request $request)
    {
        $result = $this->examService->getExamSchedule(
            $request->exam_id,
            $request->class_id
        );

        $data = [
            'getClass' => ClassModel::getClass(),
            'getClassS' => ClassModel::find($request->class_id),
            'getExam' => Exam::getExam(),
            'getRecord' => $result,
        ];

        return view('admin.exam.schedule', $data)
            ->with('success', 'My Time Table Teacher');
    }

    /**
     * Exam Schedule Insert
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function examScheduleInsert(Request $request)
    {
        $result = $this->examService->examScheduleInsert($request);
        return $result;
    }

    /**
     * My Exam of student
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function myExam(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $data['getRecord'] = $this->examService->getMyExam($class_id);

        return view('student.my_exam', $data);
    }

    /**
     * My Score exam of student
     *
     * @return mixed Result of the update operation
     */
    public function scoreStudent()
    {
        $class_id = Auth::user()->class_id;
        $data['getRecord'] = ExamScore::getRecordStudent(
            $class_id,
            Auth::user()->id
        );
        $data['getExam'] = ExamSchedule::getExam($class_id);
        $data['getSubject'] = ClassSubject::getMySubjectTeacher(
            Auth::user()->class_id
        );

        return view('student.academic_record', $data);
    }

    /**
     * My Exam Teacher
     *
     * @return mixed Result of the update operation
     */
    public function myExamTeacher()
    {
        $user_id = Auth::user()->id;
        $data['getRecord'] = $this->examService->getMyExamTeacher($user_id);

        return view('teacher.my_exam', $data);
    }
    /**
     * AcademicRecord a class teacher.
     *
     * @param int $id Class ID
     *
     * @return mixed Result of the AcademicRecord operation
     */
    public function academicScoreClass($id)
    {
        $data['getClass'] = ClassModel::find($id);
        $data['getStudent'] = User::getStudentClassExam($id);
        $data['getSubject'] = ClassSubject::MySubject($id);
        $data['getScore'] = ExamScore::getAcademicRecord($id);
        return view('teacher.class_academic_score', $data);
    }


    /**
     * My Exam score Teacher
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
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

    /**
     * ADd Exam score by Teacher
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function addScoreByTeacher(Request $request)
    {
        return $this->examService->insertScore($request);
    }

    /**
     * Get subject of class
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function getSubject(Request $request)
    {
        $getSubject = ClassSubject::MySubject($request->class_id);
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>"
                . $value->subject_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    /**
     * Get subject of teacher class
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function getSubjectTeacher(Request $request)
    {
        $getSubject = ClassTeacher::getSubjectExam(
            $request->class_id,
            Auth::user()->id
        );
        $html = "<option value=''> Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->subject_id . "'>"
                . $value->subject_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
