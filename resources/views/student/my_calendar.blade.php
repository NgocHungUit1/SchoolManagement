@extends('layouts.app')
@section('content')
    <style type="text/css">
        .fc-v-event .fc-event-title {
            bottom: 0;
            max-height: 100%;
            overflow: hidden;
            top: 0;
            font-weight: bolder;
        }
    </style>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">My Calendar</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('student/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">My Calendars</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="calendar">
                            </div>
                        </div>

                    </div>
                </div>

            </section>

        </div>



    </div>
@endsection

@push('js')
    <script src="/./dist/index.global.js"></script>
    <script type="text/javascript">
        var events = new Array();

        @foreach ($getExamTimeTable as $valueE)
            @foreach ($valueE['exam'] as $exam)
                events.push({
                    title: 'Exam : {{ $valueE['name'] }} - {{ $exam['subject_name'] }} ({{ date('h:m A', strtotime($exam['start_time'])) }} to {{ date('h:m A', strtotime($exam['end_time'])) }})',
                    start: '{{ $exam['exam_date'] }}',
                    end: '{{ $exam['exam_date'] }}',
                    color: 'red',
                    url: '{{ url('student/my-exam') }}'
                });
            @endforeach
        @endforeach

        @foreach ($getTimeTable as $value)
            @foreach ($value['day'] as $day)
                events.push({
                    title: 'Subject : {{ $value['name'] }} & Room :{{ $day['room_number'] }} & Teacher : {{ $value['teacher_name'] }} ',
                    daysOfWeek: [{{ $day['fullcalendar_day'] }}],
                    startTime: '{{ $day['start_time'] }}',
                    endTime: '{{ $day['end_time'] }}',
                });
            @endforeach
        @endforeach

        var calendarID = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarID, {
            headerToolbar: {
                left: 'prev,next today',
                centet: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: '<?= date('Y-m-d') ?>',
            navLinks: true,
            editable: false,
            events: events,
            initialView: 'timeGridWeek',
        });
        calendar.render();
    </script>
@endpush
