@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">My Exam List</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('student/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active"> MyExam List</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        @foreach ($getRecord as $value)
                            <div class="card-body">

                                <div class="page-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="page-title">{{ $value['name'] }}</h3>
                                        </div>

                                    </div>
                                </div>

                                <div class="table-responsive" id="user">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0  table-striped exam_table">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>Subject</th>
                                                <th>Day</th>
                                                <th>Exam Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Room Number</th>
                                                <th>Full Marks</th>
                                                <th>Passing Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($value['exam'] as $valueS)
                                                <tr>
                                                    <td>{{ $valueS['subject_name'] }}</td>
                                                    <td>{{ date('1', strtotime($valueS['exam_date'])) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($valueS['exam_date'])) }}</td>
                                                    <td>{{ date('h:i A', strtotime($valueS['start_time'])) }}</td>
                                                    <td>{{ date('h:i A', strtotime($valueS['end_time'])) }}</td>
                                                    <td>{{ $valueS['room_number'] }}</td>
                                                    <td>{{ $valueS['full_mark'] }}</td>
                                                    <td>{{ $valueS['passing_mark'] }}</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>



    </div>

    </div>
@endsection
