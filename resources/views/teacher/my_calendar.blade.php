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
                            <div class="student-group-form">
                                <form action="" method="get">
                                    <div class="row">
                                        @include('_message')

                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <button type="submit" name="semester_id" value="1"
                                                    class="btn btn-primary {{ Request::get('semester_id') == 1 ? 'active' : '' }}">HK1</button>
                                                <button type="submit" name="semester_id" value="2"
                                                    class="btn btn-primary {{ Request::get('semester_id') == 2 ? 'active' : '' }}">HK2</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>


                            <style>
                                .btn.active {
                                    background-color: #007bff;
                                    color: #fff;
                                }
                            </style>
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
        // Lấy giá trị của tham số 'semester_id' từ URL hiện tại
        var semesterId = new URL(window.location.href).searchParams.get("semester_id");

        // Tạo URL mới với giá trị 'semesterId' như một query parameter
        var url = new URL('{{ url('teacher/my_exam') }}');
        url.searchParams.set('semester_id', semesterId);
        @foreach ($getExamCalendar as $valueE)
            events.push({
                title: ' Class : {{ $valueE['class_name'] }} - Exam : {{ $valueE['exam_name'] }} - {{ $valueE['subject_name'] }} - ({{ date('h:m A', strtotime($valueE['start_time'])) }} to {{ date('h:m A', strtotime($valueE['end_time'])) }})',
                start: '{{ $valueE['exam_date'] }}',
                end: '{{ $valueE['exam_date'] }}',
                color: 'red',
                url: url.toString()
            });
        @endforeach

        @foreach ($getCalendarTeacher as $value)
            events.push({
                title: 'Class : {{ $value->classes->name }} - Subject : {{ $value->subjects->name }} - Room :{{ $value->room_number }} ',
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
