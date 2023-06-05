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

use App\Models\Exam;
use App\Models\User;
use App\Models\Semester;
use App\Models\ExamScore;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\ExamSchedule;
use App\Models\StudentScore;
use App\Models\StudentScoreSemester;
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
     * @param int $examId     The ID of the exam
     * @param int $classId    The ID of the class
     * @param int $semesterId The ID of the semester
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExamSchedule($examId, $classId, $semesterId)
    {

        $result = [];

        if (!empty($examId) && !empty($classId)  && !empty($semesterId)) {
            $getSubject = ClassSubject::MySubject($classId);
            $examSchedules = ExamSchedule::getExamSchedules(
                $getSubject->pluck('subject_id')->toArray(),
                $classId,
                $examId,
                $semesterId
            );

            foreach ($getSubject as $value) {
                $dataExam = [
                    'subject_id' => $value->subject_id,
                    'class_id' => $value->class_id,
                    'subject_name' => $value->subjects->name,
                    'subject_type' => $value->subjects->type,
                ];
                $examSchedule = $examSchedules->whereIn('subject_id', $value->subject_id,)
                    ->where('class_id', $classId)
                    ->where('exam_id', $examId)
                    ->where('semester_id', $semesterId)
                    ->first();

                $dataExam['exam_date'] = !empty($examSchedule) ? $examSchedule->exam_date : '';
                $dataExam['start_time'] = !empty($examSchedule) ? $examSchedule->start_time : '';
                $dataExam['end_time'] = !empty($examSchedule) ? $examSchedule->end_time : '';
                $dataExam['room_number'] = !empty($examSchedule) ? $examSchedule->room_number : '';
                $dataExam['passing_mark'] = !empty($examSchedule) ? $examSchedule->passing_mark : '';
                $dataExam['full_mark'] = !empty($examSchedule) ? $examSchedule->full_mark : '';
                $dataExam['semester_id'] = !empty($examSchedule) ? $examSchedule->semester_id : '';

                $result[] = $dataExam;
            }
        }

        return $result;
    }



    /**
     * Get Academic score  .
     *
     * @param int $id          The ID of the class
     * @param int $semester_id The ID of the semester
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAcademicData($class_id, $semester_id)
    {
        $data['class'] = ClassModel::find($class_id);
        $data['getSubject'] = ClassSubject::MySubject($class_id);
        $data['getStudent'] = User::getStudentClassExam($class_id);
        $scores = StudentScore::getAcademicRecords(
            $semester_id,
            $data['getStudent']->pluck('id'),
            $data['getSubject']->pluck('subject_id'),
        );
        $result = [];
        foreach ($data['getStudent'] as $student) {
            $result[$student->id]['avage_score'] = $student->studentScoresSemester
                ->where('semester_id', $semester_id)
                ->first()->avage_score ?? '';
            foreach ($scores as $score) {
                $result[$score->student_id][$score->subject_id] = $score->score ?? '';
            }
        }

        $data['result'] = $result;
        return $data;
    }



    /**
     * Exam Schedule Insert .
     *
     * @param  $  object
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function examScheduleInsert($exam_id, $class_id, $semester_id, $schedules)
    {
        ExamSchedule::deleteRecord(
            $exam_id,
            $class_id,
            $semester_id
        );
        $toInsert = [];
        foreach ($schedules as $schedule) {
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
                    $class_id,
                    $schedule
                );
                if ($overlapping > 0) {
                    return redirect()->back()
                        ->with('error', 'Time slot overlap detected');
                }

                $toInsert[] = [
                    'exam_id' => $exam_id,
                    'class_id' => $class_id,
                    'subject_id' => $schedule['subject_id'],
                    'exam_date' => $schedule['exam_date'],
                    'start_time' => $schedule['start_time'],
                    'end_time' => $schedule['end_time'],
                    'room_number' => $schedule['room_number'],
                    'full_mark' => $schedule['full_mark'],
                    'passing_mark' => $schedule['passing_mark'],
                    'created_by' => Auth::user()->id,
                    'semester_id' => $semester_id
                ];
            }
        }

        ExamSchedule::insert($toInsert);

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
     * Insert exam scores for a given class, subject, and semester.
     *
     * @param  $ The HTTP  object.
     *
     * @return RedirectResponse
     */
    public function insertScore($class_id, $subject_id, $semester_id, $exam_score)
    {
        $response = [
            'status' => '',
            'message' => ''
        ];
        $examIds = collect($exam_score)
            ->flatMap(function ($scores) {
                return collect($scores)->pluck('exam_id');
            })
            ->unique()
            ->toArray();
        $exams = Exam::getExamsByIds($examIds);
        ExamScore::deleteScoreByClassSubjectSemester($class_id, $subject_id, $semester_id);
        StudentScore::deleteScoreByClassSubjectSemester($class_id, $subject_id, $semester_id);
        $examScoreData = [];
        $studentScoreData = [];
        foreach ($exam_score as $studentId => $scores) {
            $total = 0;
            $total_weight = 0;
            $total_subjects_scored = 0;

            foreach ($scores as $scoreData) {

                if ($this->validateScoreData($studentId, $scoreData)) {
                    $total_subjects_scored++;
                    $exam = $exams->firstWhere('id', $scoreData['exam_id']);
                    $subtotal = $scoreData['score'] * $exam->description;
                    $total += $subtotal;
                    $total_weight += $exam->description;
                    $this->createExamScoreRecord($examScoreData, $class_id, $subject_id, $semester_id, $studentId, $scoreData);
                }
            }

            if (count($examIds) == $total_subjects_scored) {
                $this->calculateStudentAverage($studentScoreData, $class_id, $subject_id, $semester_id, $studentId, $total, $total_weight);
            }
        }
        StudentScore::insert($studentScoreData);
        ExamScore::insert($examScoreData);

        $this->updateStudentScores($class_id, $semester_id);

        $response['status'] = 'success';
        $response['message'] = 'Exam scores have been saved.';

        return $response;
    }

    public function createExamScoreRecord(&$examScoreData, $class_id, $subject_id, $semester_id, $studentId, $scoreData)
    {
        $examScoreData[] = [
            'exam_id' => $scoreData['exam_id'],
            'class_id' => $class_id,
            'semester_id' => $semester_id,
            'subject_id' => $subject_id,
            'student_id' => $studentId,
            'score' => $scoreData['score'],
            'created_by' => Auth::user()->id,
        ];
    }
    public function calculateStudentAverage(&$studentScoreData, $class_id, $subject_id, $semester_id, $studentId, $total, $total_weight)
    {

        $average = $total / $total_weight;
        $studentScoreData[] = [
            'score' => $average,
            'class_id' => $class_id,
            'semester_id' => $semester_id,
            'subject_id' => $subject_id,
            'student_id' => $studentId,
        ];
    }


    public function validateScoreData($studentId, $scoreData)
    {
        return !empty($studentId)
            && !empty($scoreData['exam_id'])
            && !empty($scoreData['score']);
    }


    public function updateStudentScores($class_id, $semester_id)
    {
        $students = User::getStudentClassExam($class_id);
        $subjects = ClassSubject::MySubject($class_id);
        $scores = StudentScore::getAcademicRecordStudent($class_id, $semester_id);
        $studentScoreSemesterData = [];

        foreach ($students as $student) {
            $scoredSubjects = $scores
                ->where('student_id', $student->id)
                ->pluck('subject_id')
                ->toArray();

            $totalScore = $scores
                ->whereIn('subject_id', $scoredSubjects)
                ->where('student_id', $student->id)
                ->sum('score');

            if (count($scoredSubjects) === count($subjects)) {
                $this->calculateAndSaveSemesterAverage($studentScoreSemesterData, $student->id, $semester_id, $totalScore, $subjects);
            }
            $semester1Average = $student->studentScoresSemester
                ->where('semester_id', 1)
                ->avg('avage_score');

            $semester2Average = $student->studentScoresSemester
                ->where('semester_id', 2)
                ->avg('avage_score');

            if ($semester1Average !== null && $semester2Average !== null) {
                $this->calculateAndSaveYearlyAverage($student, $semester1Average, $semester2Average);
            }
        }

        StudentScoreSemester::deleteScore($students->pluck('id')->toArray(), $semester_id);
        StudentScoreSemester::insert($studentScoreSemesterData);
    }

    public function calculateAndSaveSemesterAverage(&$studentScoreSemesterData, $studentId, $semesterId, $totalScore, $subjects)
    {
        $average = number_format($totalScore / count($subjects), 2);
        $studentScoreSemesterData[] = [
            'avage_score' => $average,
            'semester_id' => $semesterId,
            'student_id' => $studentId,
        ];
    }

    public function calculateAndSaveYearlyAverage($student, $semester1Average, $semester2Average)
    {
        $studentScoreSemesterYear = [];
        StudentScoreSemester::deleteScores($student->id, 3);
        $total_average = $semester1Average + ($semester2Average * 2);
        $yearly_average = number_format($total_average / 3, 2);

        switch (true) {
            case !isset($yearly_average):
                $rank = null;
                break;
            case $yearly_average < 5:
                $rank = 'D';
                break;
            case $yearly_average >= 5 && $yearly_average < 6.5:
                $rank = 'C';
                break;
            case $yearly_average >= 6.5 && $yearly_average < 8:
                $rank = 'B';
                break;
            default:
                $rank = 'A';
                break;
        }

        $studentScoreSemesterYear[] = [
            'avage_score' => $yearly_average,
            'rank' => $rank,
            'semester_id' => 3,
            'student_id' => $student->id,
        ];
        StudentScoreSemester::insert($studentScoreSemesterYear);
    }



    public function getAverages($students)
    {
        $averages = [];
        foreach ($students as $student) {
            $semester1Average = $student->studentScoresSemester
                ->where('semester_id', 1)
                ->avg('avage_score');
            $semester2Average = $student->studentScoresSemester
                ->where('semester_id', 2)
                ->avg('avage_score');
            $yearlyAverage = $student->studentScoresSemester
                ->where('semester_id', 3)
                ->avg('avage_score');
            $rank = $student->studentScoresSemester
                ->where('semester_id', 3)->value('rank');

            $averages[$student->id] = [
                'semester_1_average' => $semester1Average,
                'semester_2_average' => $semester2Average,
                'yearly_average' => $yearlyAverage,
                'rank' => $rank,
            ];
        }

        return $averages;
    }



    /**
     * Get My Exam .
     *
     * @param  $  The HTTP  object.
     * @param int     $class_id The ID of the class_id
     *
     * @return \Illuminate\View\View
     */
    public function getMyExam($semester_id, $class_id)
    {
        $data =  ExamSchedule::getMyExam($semester_id, $class_id);
        return $data;
    }

    public function getExamData($classId, $subjectId, $userId)
    {
        $data = [];
        $data['getExamSemester'] = Semester::whereIn('id', [1, 2])->get();

        $data['getClass'] = ClassModel::getStudentTeacher($userId);

        if (!empty($classId)) {
            $assigned_subjects = ClassTeacher::getAssignedSubjects($userId, $classId);

            // Check if the selected subject belongs to the assigned subjects
            if (!empty($subjectId) && !in_array($subjectId, $assigned_subjects)) {
                throw new \Exception('Unauthorized access');
            }

            $data['getSubject'] =  ClassTeacher::getSubjectExam($classId, $userId)->whereIn('subject_id', $assigned_subjects);
        }

        if (!empty($subjectId) && !empty($classId)) {
            $data['getExam'] = ExamSchedule::getExam($classId);
            $data['getStudent'] = User::getStudentClassExam($classId);
        }

        return $data;
    }

    public function getStudentScores($class_id, $semester_id)
    {
        $data['getExam'] = ExamSchedule::getExam($class_id);
        $data['getRecord'] = ExamScore::getRecordStudent(
            $class_id,
            Auth::user()->id,
            $semester_id
        );

        $data['getRecordStudent'] = StudentScore::getRecordStudent(
            $class_id,
            Auth::user()->id,
            $semester_id
        );

        $data['StudentScoreSemester'] = StudentScoreSemester::getAcademicRecordStudent(
            Auth::user()->id,
            $semester_id,
        );

        $data['StudentScoreSemesterYear'] = StudentScoreSemester::where(
            'student_id',
            Auth::user()->id
        )->where('semester_id', 3)->get();

        return $data;
    }
}
