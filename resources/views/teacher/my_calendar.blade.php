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
                                    <li class="breadcrumb-item"><a href="{{ url('teacher/dashboard') }}">Home</a></li>
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

        @foreach ($getCalendarTeacher as $value)
            events.push({
                title: 'Class : {{ $value->class_name }} - Subject : {{ $value->subject_name }} - Room :{{ $value->room_number }} ',
                daysOfWeek: [{{ $value->fullcalendar_day }}],
                startTime: '{{ $value->start_time }}',
                endTime: '{{ $value->end_time }}',
            });
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
