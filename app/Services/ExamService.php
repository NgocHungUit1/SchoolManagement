<?php

namespace App\Services;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\ExamScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamService
{
    public function getExamSchedule($examId, $classId)
    {
        $result = [];

        if (!empty($examId) && !empty($classId)) {
            $getSubject = ClassSubject::MySubject($classId);

            foreach ($getSubject as $value) {
                $dataS = [
                    'subject_id' => $value->subject_id,
                    'class_id' => $value->class_id,
                    'subject_name' => $value->subject_name,
                    'subject_type' => $value->subject_type,
                ];

                $examSchedule = ExamSchedule::getRecordSignle($examId, $classId, $value->subject_id);

                if (!empty($examSchedule)) {
                    $dataS['exam_date'] = $examSchedule->exam_date;
                    $dataS['start_time'] = $examSchedule->start_time;
                    $dataS['end_time'] = $examSchedule->end_time;
                    $dataS['room_number'] = $examSchedule->room_number;
                    $dataS['full_mark'] = $examSchedule->full_mark;
                    $dataS['passing_mark'] = $examSchedule->passing_mark;
                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['passing_mark'] = '';
                }

                $result[] = $dataS;
            }
        }

        return $result;
    }

    public function examScheduleInsert(Request $request)
    {
        ExamSchedule::deleteRecord($request->exam_id, $request->class_id);

        foreach ($request->schedule as $schedule) {
            if (!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number']) && !empty($schedule['full_mark']) && !empty($schedule['passing_mark'])) {
                // Check for overlapping time slots
                $overlapping = $this->checkTimeSlotOverlap($request->class_id, $schedule);
                if ($overlapping > 0) {
                    return redirect()->back()->with('error', 'Time slot overlap detected');
                }

                $save = new ExamSchedule([
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
                ]);
                $save->save();
            }
        }

        return redirect()->back()->with('success', 'Exam Schedule successfully created ');
    }

    private function checkTimeSlotOverlap($class_id, $schedule) {
        $overlapping = ExamSchedule::where('class_id', $class_id)
            ->where(function ($query) use ($schedule) {
                $query->where(function ($q) use ($schedule) {
                    $q->where('exam_date', '=', $schedule['exam_date'])
                        ->whereBetween('start_time', [$schedule['start_time'], $schedule['end_time']]);
                })
                    ->orWhere(function ($q) use ($schedule) {
                        $q->where('exam_date', '=', $schedule['exam_date'])
                            ->whereBetween('end_time', [$schedule['start_time'], $schedule['end_time']]);
                    })
                    ->orWhere(function ($q) use ($schedule) {
                        $q->where('exam_date', '=', $schedule['exam_date'])
                            ->where('start_time', '<', $schedule['start_time'])
                            ->where('end_time', '>', $schedule['start_time']);
                    })
                    ->orWhere(function ($q) use ($schedule) {
                        $q->where('exam_date', '=', $schedule['exam_date'])
                            ->where('start_time', '<', $schedule['end_time'])
                            ->where('end_time', '>', $schedule['end_time']);
                    });
            })->count();

        return $overlapping;
    }

    public function insertScore(Request $request)
    {
        ExamScore::where('class_id', '=', $request->class_id)
            ->where('subject_id', '=', $request->subject_id)
            ->delete();

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

}
