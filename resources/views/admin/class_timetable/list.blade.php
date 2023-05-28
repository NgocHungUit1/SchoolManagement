@extends('layouts.app')
@section('content')
    <title>List User</title>
    <link rel="shortcut icon" href="/..//../assets/img/favicon.png">

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
                                <h3 class="page-title">Class Time Table</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Class Time Table</li>
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
                                    <select class="form-control getClass" name="class_id">
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
                                    <select class="form-control getSubject" name="subject_id">
                                        <option value="">Select Subject </option>
                                        @if (!empty($getSubject))
                                            @foreach ($getSubject as $subject)
                                                <option
                                                    {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}
                                                    value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                            @endforeach
                                        @endif
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
                @if (!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
                    <form action="{{ url('admin/class_timetable/add') }}" method="post">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                        <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                        <input type="hidden" name="semester_id" value="{{ Request::get('semester_id') }}">
                        <div class="col-lg-3 col-md-6">
                            <label for="start_date" style="max-width: 50%;">Start Date:</label>
                            <input type="date" class="form-control" name="start_date"
                                value="{{ isset($ClassSubjectDate->start_date) ? $ClassSubjectDate->start_date : '' }}">
                            <label for="end_date" style="max-width: 50%;">End Date:</label>
                            <input type="date" class="form-control" name="end_date"
                                value="{{ isset($ClassSubjectDate->end_date) ? $ClassSubjectDate->end_date : '' }}">
                        </div>
                        <br>


                        <div class="table-responsive" id="user">
                            <h3 class="page-title">Class Time Table</h3>
                            <table class="table border-0 star-student  table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>Day Of Week</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Class Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($day as $value)
                                        <tr>
                                            <th>
                                                <input type="hidden" name="timetable[{{ $i }}][day_id]"
                                                    value="{{ $value['day_id'] }}">{{ $value['day_name'] }}
                                            </th>
                                            <td><input type="time" name="timetable[{{ $i }}][start_time]"
                                                    value="{{ $value['start_time'] }}" class="form-control"></td>
                                            <td><input type="time" name="timetable[{{ $i }}][end_time]"
                                                    value="{{ $value['end_time'] }}" class="form-control"></td>
                                            <td><input type="text" name="timetable[{{ $i }}][room_number]"
                                                    value="{{ $value['room_number'] }}" class="form-control"></td>
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
