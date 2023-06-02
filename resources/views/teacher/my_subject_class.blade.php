@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Subject & Class</title>
    <link rel="shortcut icon" href="/..//../assets/img/favicon.png">


    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">My Subject & Class</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('teacher/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">My Subject & Class</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">My Subject & Class</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>Created Day</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $key => $value)
                                            <tr id="sid{{ $value->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->classes->name }}</td>
                                                <td>{{ $value->subjects->name }}</td>
                                                <td>{{ $value->subjects->type }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a style="color:white" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#studentUser"
                                                        data-class-id="{{ $value['class_id'] }}"
                                                        data-subject-id="{{ $value['subject_id'] }}">
                                                        Class Subject Time Table
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    @push('js')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#studentUser').on('show.bs.modal', function(e) {
                    var class_id = $(e.relatedTarget).data('class-id');
                    var subject_id = $(e.relatedTarget).data('subject-id');
                    $.ajax({
                        url: '/teacher/my-subject-class/timetable/' + class_id + '/' + subject_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var tbody = $('#timetable-table').find('tbody');
                            tbody.empty();
                            data.forEach(function(item) {
                                var tr = $('<tr></tr>');
                                tr.append('<td>' + item.day_name + '</td>');
                                tr.append('<td>' + item.start_time + '</td>');
                                tr.append('<td>' + item.end_time + '</td>');
                                tr.append('<td>' + item.room_number + '</td>');
                                tbody.append(tr);

                                $('#start_date').val(data[0].start_date);
                                $('#end_date').val(data[0].end_date);
                                $('#date_range_input').val(data[0].start_date);
                                $('#date_range_input').attr('min', data[0].start_date);
                                $('#date_range_input').attr('max', data[0].end_date);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
