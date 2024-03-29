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
use App\Models\Semester;
use App\Models\StudentScore;
use App\Models\StudentScoreSemester;
use App\Models\User;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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
        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        $semester_id = $request->semester_id;
        $exam_score = $request->exam_score;

        $response = $this->examService->insertScore($class_id, $subject_id, $semester_id, $exam_score);

        if ($response['status'] === 'success') {
            return redirect()->back()->with('success', 'Exam scores have been saved.');
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
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

    public function getData(Request $request)
    {
        $exam_name = $request->query('exam');
        $data['data'] = Exam::getRecord($exam_name);
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
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::MySubject($request->class_id);
        }

        if (
            !empty($request->subject_id) && !empty($request->class_id)
            && !empty($request->semester_id)
        ) {
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
        $data['getRecord'] = ClassModel::getClassAcademic();

        return view('admin.exam.academic', $data);
    }

    /**
     * AcademicRecord a class.
     *
     * @param int $id          Class ID
     * @param int $semester_id Semester ID
     *
     * @return mixed Result of the AcademicRecord operation
     */
    public function academicRecord($id, $semester_id)
    {
        $data = $this->examService->getAcademicData($id, $semester_id);

        if (Auth::user()->user_type == 1) {
            return view('admin.exam.academic_record', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.academic_record', $data);
        }

        return view('admin.exam.academic_record', $data);
    }

    /**
     * AcademicRecord year a class.
     *
     * @param int $id Class ID
     *
     * @return mixed Result of the AcademicRecord operation
     */
    public function academicRecords($class_id)
    {
        $data['getClass'] = ClassModel::find($class_id);
        $data['getStudent'] = User::getStudentClassExam($class_id);
        $data['getSubject'] = ClassSubject::MySubject($class_id);
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getRecord'] = ClassModel::getClassAcademic();
        $studentAverages = $this->examService->getAverages($data['getStudent']);
        if (Auth::user()->user_type == 1) {
            return view('admin.exam.academic_record_year', $data, compact('studentAverages'));
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.academic_record_year', $data, compact('studentAverages'));
        }
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
            $request->class_id,
            $request->semester_id,
        );

        $data = [
            'getClass' => ClassModel::getClass(),
            'getClassS' => ClassModel::find($request->class_id),
            'getExam' => Exam::getExam(),
            'getRecord' => $result,
            'getExamSemester' => Semester::whereIn('id', [1, 2])->get(),
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
        $exam_id = $request->input('exam_id');
        $class_id = $request->input('class_id');
        $semester_id = $request->input('semester_id');
        $schedules = $request->input('schedule');

        $result = $this->examService->examScheduleInsert(
            $exam_id,
            $class_id,
            $semester_id,
            $schedules
        );

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
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getRecord'] = $this->examService->getMyExam($request->semester_id, $class_id);

        return view('student.my_exam', $data);
    }

    /**
     * My Score exam of student
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function scoreStudent(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $semester_id = $request->semester_id;

        $data = $this->examService->getStudentScores($class_id, $semester_id);

        return view('student.academic_record', $data);
    }

    /**
     * My Exam Teacher
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the update operation
     */
    public function myExamTeacher(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $data['getRecord'] = ExamSchedule::getExamCalendarTeacher($teacher_id, $request->semester_id);
        return view('teacher.my_exam', $data);
    }
    /**
     * AcademicRecord a class teacher.
     *
     * @param int $id          Class ID
     * @param int $semester_id Semester ID
     *
     * @return mixed Result of the AcademicRecord operation
     */
    public function academicScoreClass($id, $semester_id)
    {
        $data['getClass'] = ClassModel::find($id);
        $data['getStudent'] = User::getStudentClassExam($id);
        $data['getSubject'] = ClassSubject::MySubject($id);
        $data['getScore'] = StudentScore::getAcademicRecordStudent($id, $semester_id);
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

        $classId = $request->input('class_id');
        $subjectId = $request->input('subject_id');

        try {
            $data = $this->examService->getExamData($classId, $subjectId, Auth::user()->id);
        } catch (\Exception $e) {
            return redirect(URL::previous())->with('error', $e->getMessage());
        }

        return view('teacher.exam_score', $data);
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
                . $value->subjects->name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
