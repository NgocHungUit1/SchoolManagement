@extends('layouts.app')
@section('content')

    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Exam Score</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Exam Score</li>
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
                                                value="{{ $class->id }}">Class : {{ $class->name }}</option>
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
                                                    value="{{ $subject->subject_id }}">Subject :
                                                    {{ $subject->subject_name }}</option>
                                            @endforeach
                                        @endif
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
                @if (!empty($getExam) && !empty($getExam->count()))
                    <div class="table-responsive" id="user">
                        <h3 class="page-title">Mark Register</h3>
                        <table class="table border-0 star-student  table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>Student Name</th>
                                    @foreach ($getExam as $exam)
                                        <th>
                                            {{ $exam->exam_name }}
                                        </th>
                                    @endforeach
                                    <th>Average Score</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($getStudent) && !empty($getStudent->count()))
                                    @foreach ($getStudent as $student)
                                        <form class="submitForm" method="post">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                            <input type="hidden" name="subject_id"
                                                value="{{ Request::get('subject_id') }}">
                                            <tr>
                                                <td>{{ $student->name }}</td>
                                                @php
                                                    $i = 1;
                                                    $total = 0;
                                                @endphp
                                                @foreach ($getExam as $exam)
                                                    @php
                                                        $getScore = $exam->getScore(Request::get('class_id'), $student->id, $exam->exam_id, Request::get('subject_id'));
                                                        if (!empty($getScore)) {
                                                            $subtotal = ($getScore->score * $exam->percent) / 100;
                                                            $total += $subtotal;
                                                        }
                                                    @endphp
                                                    <td>
                                                        <input type="hidden"
                                                            name="exam_score[{{ $i }}][exam_id]"
                                                            value="{{ $exam->exam_id }}">
                                                        <input type="text" name="exam_score[{{ $i }}][score]"
                                                            value="{{ !empty($getScore->score) ? $getScore->score : '' }}"
                                                            placeholder="Score" class="form-control">
                                                    </td>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                                @if ($total < 5)
                                                    <td style="color:crimson">{{ $total }}</td>
                                                @else
                                                    <td>{{ $total }}</td>
                                                @endif
                                                <td>
                                                    <button type="submit" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#myModal">Submit</button>
                                                </td>
                                            </tr>
                                        </form>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                @endif
            </div>

        </div>



    </div>


    <div class="modal fade contentmodal" id="myModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">

                </div>
                <div class="modal-body">
                    <div class="delete-wrap text-center">
                        <div class="del-icon">
                            <i class="feather-check-circle text-success"></i>
                        </div>
                        <h2>Thêm điểm thành công</h2>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @push('js')
        <script>
            $('.submitForm').submit(function(e) {
                e.preventDefault();

                var $form = $(this);

                $.ajax({
                    url: "{{ url('teacher/exam/exam_score') }}",
                    type: "POST",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function(data) {


                    },

                });
            });
        </script>



        <script type="text/javascript">
            $('.getClass').change(function() {
                var class_id = $(this).val();
                $.ajax({
                    url: " {{ url('teacher/exam/get_subject') }}",
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @endpush
@endsection
