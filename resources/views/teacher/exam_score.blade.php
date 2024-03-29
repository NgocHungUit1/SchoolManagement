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
                                                    {{ $subject->subjects->name }}</option>
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
                @if (!empty($getExam) && !empty($getExam->count()))
                    <div class="table-responsive" id="user">
                        <h3 class="page-title">Mark Register</h3>

                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                            <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                            <input type="hidden" name="semester_id" value="{{ Request::get('semester_id') }}">
                            <table class="table border-0 star-student datatable table-striped">
                                <br>
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <br>
                                <thead class="student-thread">
                                    <tr>
                                        <th>Student Name</th>
                                        @foreach ($getExam as $exam)
                                            <th>{{ $exam->exam->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getStudent) && !empty($getStudent->count()))
                                        @php
                                            $all_exam = count($getExam);
                                        @endphp
                                        @foreach ($getStudent as $student)
                                            <tr>
                                                <td>{{ $student->name }}</td>
                                                @php
                                                    $i = 1;
                                                    
                                                @endphp
                                                @foreach ($getExam as $exam)
                                                    @php
                                                        $getScore = $exam->getScoreSemester(Request::get('class_id'), $student->id, $exam->exam_id, Request::get('subject_id'), Request::get('semester_id'));
                                                        
                                                    @endphp
                                                    <td>
                                                        <input type="hidden"
                                                            name="exam_score[{{ $student->id }}][{{ $exam->exam_id }}][exam_id]"
                                                            value="{{ $exam->exam_id }}">
                                                        <input type="text"
                                                            name="exam_score[{{ $student->id }}][{{ $exam->exam_id }}][score]"
                                                            value="{{ !empty($getScore->score) ? $getScore->score : '' }}"
                                                            placeholder="Score" class="form-control">
                                                    </td>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>


                        </form>
                    </div>
                @endif


            </div>

        </div>



    </div>



    @push('js')
        <script>
            $('.submitForm').submit(function(e) {
                e.preventDefault();

                var $form = $(this);

                $.ajax({
                    url: "{{ url('admin/exam/exam_score') }}",
                    type: "POST",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function(data) {
                        if (data.message == "Exam score successfully saved") {
                            // Lấy giá trị total từ server và cập nhật lại giá trị của td chứa $total
                            $form.find("td:last-child").html(data.total);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
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
