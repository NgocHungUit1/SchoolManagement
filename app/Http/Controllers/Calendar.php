<?php

namespace App\Http\Controllers;
use App\Lesson;
use App\Services\CalendarService;

class Calendar extends Controller
{
    public function index(CalendarService $calendarService)
    {
        $weekDays = Lesson::WEEK_DAYS;
        $calendarData = $calendarService->generateCalendarData($weekDays);

        return view('admin.calendar', compact('weekDays', 'calendarData'));
    }
}
