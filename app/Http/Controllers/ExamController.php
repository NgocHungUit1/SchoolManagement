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
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::MySubject($request->class_id);
        }

        if (!empty($request->subject_id) && !empty($request->class_id) && !empty($request->semester_id)) {
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
     * @param int $id Class ID
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

    public function academicRecords($id)
    {
        $data['getClass'] = ClassModel::find($id);
        $data['getStudent'] = User::getStudentClassExam($id);
        $data['getSubject'] = ClassSubject::MySubject($id);
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
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getRecord'] = $this->examService->getMyExam($request, $class_id);

        return view('student.my_exam', $data);
    }

    /**
     * My Score exam of student
     *
     * @return mixed Result of the update operation
     */
    public function scoreStudent(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $semester_id = $request->semester_id;
        $data['getRecord'] = ExamScore::getRecordStudent(
            $class_id,
            Auth::user()->id,
            $semester_id
        );
        $data['getExam'] = ExamSchedule::getExam($class_id);
        $data['getSubject'] = ClassSubject::getMySubjectTeacher(
            Auth::user()->class_id
        );
        $data['StudentScoreSemester'] = StudentScoreSemester::where(
            'student_id',
            Auth::user()->id
        )->where('semester_id', 3)->get();
        return view('student.academic_record', $data);
    }

    /**
     * My Exam Teacher
     *
     * @return mixed Result of the update operation
     */
    public function myExamTeacher(Request $request)
    {
        $user_id = Auth::user()->id;
        $data['getRecord'] = $this->examService->getMyExamTeacher($request, $user_id);

        return view('teacher.my_exam', $data);
    }
    /**
     * AcademicRecord a class teacher.
     *
     * @param int $id Class ID
     *
     * @return mixed Result of the AcademicRecord operation
     */
    public function academicScoreClass($id, $semester_id)
    {
        $data['getClass'] = ClassModel::find($id);
        $data['getStudent'] = User::getStudentClassExam($id);
        $data['getSubject'] = ClassSubject::MySubject($id);
        $data['getScore'] = ExamScore::getAcademicRecords($id, $semester_id);
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
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getClass'] = ClassModel::getStudentTeacher(Auth::user()->id);
        $class_id = $request->input('class_id');
        // Kiểm tra xem môn học được chọn có thuộc danh sách các môn học được phân công cho giáo viên hay không
        $assigned_subjects = ClassTeacher::getAssignedSubjects(Auth::user()->id, $class_id);
        $subject_id = $request->input('subject_id');
        if (!empty($subject_id) && !in_array($subject_id, $assigned_subjects)) {
            return redirect(URL::previous())->with('error', 'Unauthorized access ');
        }

        if (!empty($request->class_id)) {
            $data['getSubject'] =  ClassTeacher::getSubjectExam(
                $request->class_id,
                Auth::user()->id
            )->whereIn('subject_id', $assigned_subjects); // Thêm điều kiện kiểm tra môn học
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
