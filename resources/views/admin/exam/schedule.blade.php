@extends('layouts.app')
@section('content')


    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/../assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/../assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="/../assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="/../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/../assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="/../assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="/../assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Exam Schedule</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Exam Schedule</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="student-group-form">
                    <form action="" method="get">
                        <div class="row">
                            @include('_message')
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <select class="form-control " name="exam_id">
                                        <option value="">Select Exam </option>
                                        @if (!empty($getExam))
                                            @foreach ($getExam as $exam)
                                                <option {{ Request::get('exam_id') == $exam->id ? 'selected' : '' }}
                                                    value="{{ $exam->id }}">{{ $exam->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <select class="form-control " name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach ($getClass as $class)
                                            <option {{ Request::get('class_id') == $class->id ? 'selected' : '' }}
                                                value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <select class="form-control " name="semester_id">
                                        @foreach ($getExamSemester as $value)
                                            <option {{ Request::get('semester_id') == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="search-student-btn">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                    </form>
                </div>
                @if (!empty($getRecord))
                    <form action="{{ url('admin/exam_schedule/add') }}" method="post">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                        <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                        <input type="hidden" name="semester_id" value="{{ Request::get('semester_id') }}">
                        <div class="table-responsive" id="user">
                            <h3 class="page-title">Exam Schedule</h3>
                            <table class="table border-0 star-student  table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Exam Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Class Room</th>
                                        <th>Full Marks</th>
                                        <th>Passing Marks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($getRecord as $value)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="schedule[{{ $i }}][subject_id]"
                                                    value="{{ $value['subject_id'] }}">{{ $value['subject_name'] }}
                                            </td>
                                            <td>
                                                <input id="datepicker" type="date"
                                                    name="schedule[{{ $i }}][exam_date]"
                                                    value="{{ $value['exam_date'] }}" class="form-control">

                                            </td>
                                            <td>
                                                <input type="time" name="schedule[{{ $i }}][start_time]"
                                                    value="{{ $value['start_time'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="time" name="schedule[{{ $i }}][end_time]"
                                                    value="{{ $value['end_time'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="schedule[{{ $i }}][room_number]"
                                                    value="{{ $value['room_number'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="schedule[{{ $i }}][full_mark]"
                                                    value="{{ $value['full_mark'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="schedule[{{ $i }}][passing_mark]"
                                                    value="{{ $value['passing_mark'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <a style="color:white" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#studentUser"
                                                    data-class-id="{{ $value['class_id'] }}"
                                                    data-subject-id="{{ $value['subject_id'] }}"
                                                    data-semester-id="{{ $value['semester_id'] }}">
                                                    Class Subject Time Table
                                                </a>

                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="text-align:center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>

        </div>



    </div>
    <div class="modal fade contentmodal" id="studentUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="date_range" style="font-weight: bold;">Start date</label>
                    <input type="date" class="form-control" name="date_range" id="start_date" value="">
                    <label for="date_range" style="font-weight: bold;">End Date:</label>
                    <input type="date" class="form-control" name="date_range" id="end_date" value="">
                    <label for="date_range" style="font-weight: bold;">Date Range:</label>
                    <input type="date" class="form-control" name="date_range" id="date_range_input" value="">
                    <table id="timetable-table" class="table border-0 star-student  table-striped">
                        <thead class="student-thread">
                            <tr>
                                <th>Day Of Week</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Class Room</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    </div>
    <script src="/../assets/js/jquery-3.6.0.min.js"></script>

    <script src="/../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/../assets/js/feather.min.js"></script>

    <script src="/../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="/../assets/plugins/datatables/datatables.min.js"></script>
    <script src="/../assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script type="text/javascript">
        $('.getClass').change(function() {
            var class_id = $(this).val();

            $.ajax({
                url: " {{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id: class_id,
                },
                dataType: "json",
                success: function(response) {
                    $('.getSubject').html(response.html);
                },
            });
        });


        $(document).ready(function() {
            $('#studentUser').on('show.bs.modal', function(e) {
                var class_id = $(e.relatedTarget).data('class-id');
                var subject_id = $(e.relatedTarget).data('subject-id');
                var semester_id = $(e.relatedTarget).data('semester-id');

                $.ajax({
                    url: '/admin/my-subject-class/timetable/' + class_id + '/' + subject_id + '/' +
                        semester_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tbody = $('#timetable-table').find('tbody');
                        tbody.empty();

                        var start_date = '';
                        var end_date = '';

                        data.forEach(function(item) {
                            var tr = $('<tr></tr>');
                            tr.append('<td>' + item.day_name + '</td>');
                            tr.append('<td>' + item.start_time + '</td>');
                            tr.append('<td>' + item.end_time + '</td>');
                            tr.append('<td>' + item.room_number + '</td>');
                            tbody.append(tr);

                            if (item.start_date && item.end_date) {
                                start_date = item.start_date;
                                end_date = item.end_date;
                            }
                        });

                        $('#start_date').val(start_date);
                        $('#end_date').val(end_date);
                        $('#date_range_input').val(start_date);
                        $('#date_range_input').attr('min', start_date);
                        $('#date_range_input').attr('max', end_date);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>


@endsection
