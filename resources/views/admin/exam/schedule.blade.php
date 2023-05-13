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
                                                <input type="date" name="schedule[{{ $i }}][exam_date]"
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

    </div>






    <script src="/../assets/js/jquery-3.6.0.min.js"></script>

    <script src="/../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/../assets/js/feather.min.js"></script>

    <script src="/../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="/../assets/plugins/datatables/datatables.min.js"></script>
    <script src="/../assets/js/script.js"></script>

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
    </script>
@endsection
