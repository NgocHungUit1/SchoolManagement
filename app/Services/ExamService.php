<?php

/**
 *  ExamService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\ExamSchedule;
use App\Models\Exam;
use App\Models\ExamScore;
use App\Models\Semester;
use App\Models\StudentScore;
use App\Models\StudentScoreSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ExamService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class ExamService
{
    /**
     * Get Exam Schedule .
     *
     * @param int $examId  The ID of the exam
     * @param int $classId The ID of the class
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAcademicData($id, $semester_id)
    {
        $data['getClass'] = ClassModel::find($id);
        $data['getSubject'] = ClassSubject::MySubject($id);
        $data['getScore'] = ExamScore::getAcademicRecords($id, $semester_id);
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();
        $data['getRecord'] = ClassModel::getClassAcademic();
        $data['getStudent'] = User::getStudentClassExam($id);

        return $data;
    }


    public function getExamSchedule($examId, $classId, $semesterId)
    {

        $result = [];

        if (!empty($examId) && !empty($classId)  && !empty($semesterId)) {
            $getSubject = ClassSubject::MySubject($classId);
            foreach ($getSubject as $value) {
                $dataS = [
                    'subject_id' => $value->subject_id,
                    'class_id' => $value->class_id,
                    'subject_name' => $value->subject_name,
                    'subject_type' => $value->subject_type,
                ];

                $examSchedule = ExamSchedule::getRecordSignle(
                    $examId,
                    $classId,
                    $value->subject_id,
                    $semesterId
                );

                if (!empty($examSchedule)) {
                    $dataS['exam_date'] = $examSchedule->exam_date;
                    $dataS['start_time'] = $examSchedule->start_time;
                    $dataS['end_time'] = $examSchedule->end_time;
                    $dataS['room_number'] = $examSchedule->room_number;
                    $dataS['full_mark'] = $examSchedule->full_mark;
                    $dataS['passing_mark'] = $examSchedule->passing_mark;
                    $dataS['semester_id'] = $examSchedule->semester_id;
                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['passing_mark'] = '';
                    $dataS['semester_id'] = '';
                }

                $result[] = $dataS;
            }
        }

        return $result;
    }

    /**
     * Exam Schedule Insert .
     *
     * @param Request $request Request object
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function examScheduleInsert(Request $request)
    {

        ExamSchedule::deleteRecord($request->exam_id, $request->class_id, $request->semester_id);

        foreach ($request->schedule as $schedule) {
            if (
                !empty($schedule['subject_id'])
                && !empty($schedule['exam_date'])
                && !empty($schedule['start_time'])
                && !empty($schedule['end_time'])
                && !empty($schedule['room_number'])
                && !empty($schedule['full_mark'])
                && !empty($schedule['passing_mark'])
            ) {
                // Check for overlapping time slots
                $overlapping = $this->_checkTimeSlotOverlap(
                    $request->class_id,
                    $schedule
                );
                if ($overlapping > 0) {
                    return redirect()->back()
                        ->with('error', 'Time slot overlap detected');
                }

                $save = new ExamSchedule(
                    [
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'subject_id' => $schedule['subject_id'],
                        'exam_date' => $schedule['exam_date'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'],
                        'room_number' => $schedule['room_number'],
                        'full_mark' => $schedule['full_mark'],
                        'passing_mark' => $schedule['passing_mark'],
                        'created_by' => Auth::user()->id,
                        'semester_id' => $request->semester_id // Lưu exam_schedule theo học kì
                    ]
                );
                $save->save();
            }
        }

        return redirect()->back()
            ->with('success', 'Exam Schedule successfully created ');
    }

    /**
     * Check Time Slot Overlap.
     *
     * @param int $class_id The ID of the class_id
     * @param int $schedule The ID of the schedule
     *
     * @return \Illuminate\View\View
     */
    private function _checkTimeSlotOverlap($class_id, $schedule)
    {
        $overlapping = ExamSchedule::where('class_id', $class_id)
            ->where(
                function ($query) use ($schedule) {
                    $query->where(
                        function ($q) use ($schedule) {
                            $q->where('exam_date', '=', $schedule['exam_date'])
                                ->whereBetween(
                                    'start_time',
                                    [
                                        $schedule['start_time'],
                                        $schedule['end_time']
                                    ]
                                );
                        }
                    )
                        ->orWhere(
                            function ($q) use ($schedule) {
                                $q->where('exam_date', '=', $schedule['exam_date'])
                                    ->whereBetween(
                                        'end_time',
                                        [
                                            $schedule['start_time'],
                                            $schedule['end_time']
                                        ]
                                    );
                            }
                        )
                        ->orWhere(
                            function ($q) use ($schedule) {
                                $q->where('exam_date', '=', $schedule['exam_date'])
                                    ->where(
                                        'start_time',
                                        '<',
                                        $schedule['start_time']
                                    )
                                    ->where(
                                        'end_time',
                                        '>',
                                        $schedule['start_time']
                                    );
                            }
                        )
                        ->orWhere(
                            function ($q) use ($schedule) {
                                $q->where('exam_date', '=', $schedule['exam_date'])
                                    ->where(
                                        'start_time',
                                        '<',
                                        $schedule['end_time']
                                    )
                                    ->where(
                                        'end_time',
                                        '>',
                                        $schedule['end_time']
                                    );
                            }
                        );
                }
            )->count();

        return $overlapping;
    }
    /**
     * Insert Score.
     *
     * @param Request $request Request object
     *
     * @return \Illuminate\View\View
     */
    public function insertScore(Request $request)
    {

        ExamScore::where('class_id', '=', $request->class_id)
            ->where('subject_id', '=', $request->subject_id)
            ->where('semester_id', '=', $request->semester_id)
            ->delete();
        $examScores = $request->input('exam_score');
        foreach ($examScores as $studentId => $scores) {
            $total = 0;
            $total_weight = 0;
            foreach ($scores as $scoreData) {

                if (
                    !empty($studentId)
                    && !empty($scoreData['exam_id'])
                    && !empty($scoreData['score'])
                ) {
                    $exam = Exam::find($scoreData['exam_id']);
                    $subtotal = $scoreData['score'] * $exam->description;
                    $total += $subtotal;
                    $total_weight += $exam->description;
                    ExamScore::create(
                        [
                            'exam_id' => $scoreData['exam_id'],
                            'class_id' => $request->input('class_id'),
                            'semester_id' => $request->input('semester_id'),
                            'subject_id' => $request->input('subject_id'),
                            'student_id' => $studentId,
                            'score' => $scoreData['score'],
                            'created_by' => Auth::user()->id,
                        ]
                    );
                }
            }
            $this->calculateStudentAverage($request, $studentId, $total, $total_weight);
        }

        $data['getStudent'] = User::getStudentClassExam($request->input('class_id'));
        $data['getSubject'] = ClassSubject::MySubject($request->input('class_id'));
        $data['getScore'] = ExamScore::getAcademicRecords(
            $request->input('class_id'),
            $request->input('semester_id')
        );

        foreach ($data['getStudent'] as $student) {
            $scored_subjects = []; // Khởi tạo một mảng tạm thời để lưu trữ các subject_id đã được chấm điểm của học sinh
            $total_score = 0;
            $total_subjects_scored = 0;

            $total_average = 0;
            foreach ($data['getSubject'] as $subject) {
                $scores = $data['getScore']->where('subject_id', $subject->subject_id)
                    ->where('student_id', $student->id)
                    ->first()->score ?? '';
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
                StudentScoreSemester::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'semester_id' => $request->input('semester_id'),
                    ],
                    [
                        'avage_score' => $average,
                        'semester_id' => $request->input('semester_id'),
                        'student_id' => $student->id
                    ]
                );
            }
            $semester_1_average_score = StudentScoreSemester::where('student_id', $student->id)
                ->where('semester_id', 1)
                ->first()->avage_score ?? null;
            // Lấy điểm trung bình kỳ học 1 của học sinh

            $semester_2_average_score = StudentScoreSemester::where('student_id', $student->id)
                ->where('semester_id', 2)
                ->first()->avage_score ?? null;
            // Lấy điểm trung bình kỳ học 2 của học sinh

            $total_average = $semester_1_average_score + $semester_2_average_score * 2;

            // Tính điểm trung bình cả năm của học sinh
            if ($total_average > 0 &&  $semester_1_average_score > 0 && $semester_2_average_score > 0) {
                $yearly_average = number_format($total_average / 3, 2);
            } else {
                $yearly_average = null;
            }

            if (!isset($yearly_average)) {
                $rank = null;
            } else if ($yearly_average < 5) {
                $rank = 'D';
            } else if ($yearly_average >= 5 && $yearly_average < 6.5) {
                $rank = 'C';
            } else if ($yearly_average >= 6.5 && $yearly_average < 8) {
                $rank = 'B';
            } else {
                $rank = 'A';
            }
            StudentScoreSemester::updateOrCreate(
                ['student_id' => $student->id, 'semester_id' => 3],
                [
                    'avage_score' => $yearly_average,
                    'rank' => $rank
                ],
            );
        }


        return redirect()->back()
            ->with('success', 'Exam scores have been saved.');
    }

    public function getAverages($students)
    {
        $averages = [];

        foreach ($students as $student) {
            $semester1Average = $this->getSemesterAverage($student->id, 1);
            $semester2Average = $this->getSemesterAverage($student->id, 2);
            $yearlyAverage = $this->getYearlyAverage($student->id);
            $rank = $this->getRank($student->id);

            $averages[$student->id] = [
                'semester_1_average' => $semester1Average,
                'semester_2_average' => $semester2Average,
                'yearly_average' => $yearlyAverage,
                'rank' => $rank,
            ];
        }

        return $averages;
    }

    private function getSemesterAverage($studentId, $semesterId)
    {
        return StudentScoreSemester::where('student_id', $studentId)
            ->where('semester_id', $semesterId)
            ->value('avage_score');
    }

    private function getYearlyAverage($studentId)
    {
        return StudentScoreSemester::where('student_id', $studentId)
            ->where('semester_id', 3)
            ->value('avage_score');
    }

    private function getRank($studentId)
    {
        return StudentScoreSemester::where('student_id', $studentId)
            ->value('rank');
    }

    private function calculateStudentAverage($request, $studentId, $total, $total_weight)
    {
        if ($total_weight > 0) {
            $average = $total / $total_weight;
            StudentScore::updateOrCreate(
                [
                    'class_id' => $request->input('class_id'),
                    'semester_id' => $request->input('semester_id'),
                    'subject_id' => $request->input('subject_id'),
                    'student_id' => $studentId,
                ],
                [
                    'score' => $average,
                    'class_id' => $request->input('class_id'),
                    'semester_id' => $request->input('semester_id'),
                    'subject_id' => $request->input('subject_id'),
                    'student_id' => $studentId,
                ]
            );
        }
    }


    /**
     * Get My Exam .
     *
     * @param int $class_id The ID of the class_id
     *
     * @return \Illuminate\View\View
     */
    public function getMyExam($request, $class_id)
    {
        $getExam = ExamSchedule::getExam($class_id);
        $semester_id = $request->semester_id;
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimeTable = ExamSchedule::getExamTimeTable(
                $value->exam_id,
                $class_id,
                $semester_id
            );

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

        return $result;
    }
    /**
     * Get My Exam Teacher.
     *
     * @param int $user_id The ID of the user
     *
     * @return \Illuminate\View\View
     */
    public function getMyExamTeacher($request, $user_id)
    {
        $result = array();
        $semester_id = $request->semester_id;
        $getClass = ClassTeacher::getMyClassTeacher($user_id);
        foreach ($getClass as $class) {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $getExam = ExamSchedule::getExamTeacher(
                $class->class_id,
                $class->subject_id
            );
            $examArray = array();
            foreach ($getExam as $exam) {
                $dataE = array();
                $dataE['name'] = $exam->exam_name;
                $getExamTimeTable = ExamSchedule::getExamTimeTableTeacher(
                    $exam->exam_id,
                    $class->class_id,
                    $class->subject_id,
                    $semester_id
                );
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

        return $result;
    }

    /**
     * Add Scores By Teacher.
     *
     * @param int $classId    The ID of the classId
     * @param int $subjectId  The ID of the subjectId
     * @param $examScores The ID of the examScores
     *
     * @return \Illuminate\View\View
     */
    public function addScoresByTeacher($classId, $subjectId, $examScores)
    {
        ExamScore::where('class_id', '=', $classId)
            ->where('subject_id', '=', $subjectId)->delete();

        foreach ($examScores as $studentId => $scores) {
            foreach ($scores as $scoreData) {
                if (
                    !empty($studentId)
                    && !empty($scoreData['exam_id'])
                    && !empty($scoreData['score'])
                ) {

                    ExamScore::create(
                        [
                            'exam_id' => $scoreData['exam_id'],
                            'class_id' => $classId,
                            'subject_id' => $subjectId,
                            'student_id' => $studentId,
                            'score' => $scoreData['score'],
                            'created_by' => Auth::user()->id,
                        ]
                    );
                }
            }
        }
    }
}
