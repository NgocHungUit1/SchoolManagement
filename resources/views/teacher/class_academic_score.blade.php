@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Academic Score</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Academic Score</li>
                                </ul>
                            </div>
                        </div>
                        <div class="student-group-form">
                            <form action="" method="get">
                                <div class="row">
                                    @include('_message')
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <a style="color: white"
                                                href="{{ url('teacher/my-class/score/' . $getClass->id . '/' . '1') }}"
                                                class="btn btn-primary ">HK1
                                            </a>
                                            <a style="color: white"
                                                href="{{ url('teacher/my-class/score/' . $getClass->id . '/' . '2') }}"
                                                class="btn btn-primary ">HK2
                                            </a>
                                            <a style="color: white"
                                                href="{{ url('teacher/academic_record_year/' . $getClass->id) }}"
                                                class="btn btn-primary ">Summary
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="user">
                    <h3 class="page-title">Class {{ $getClass->name }}</h3>
                    <form action="" method="post">
                        @csrf
                        <table class="table border-0 star-student datatable table-striped">

                            <thead class="student-thread">
                                <tr>
                                    <th>Student Name</th>
                                    @foreach ($getSubject as $value)
                                        <th>{{ $value->subjects->name }}</th>
                                    @endforeach
                                    <th>Average Score</th>
                                    <th>Classification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($getStudent) && !empty($getStudent->count()))
                                    @php
                                        $all_subjects = count($getSubject);
                                    @endphp

                                    @foreach ($getStudent as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            @php
                                                $total_score = 0;
                                                $total_subjects_scored = 0;
                                            @endphp

                                            @foreach ($getSubject as $subject)
                                                @php
                                                    $scores =
                                                        $getScore
                                                            ->where('subject_id', $subject->subject_id)
                                                            ->where('student_id', $student->id)
                                                            ->first()->score ?? '';
                                                    if (!empty($scores)) {
                                                        $total_score += $scores;
                                                        $total_subjects_scored++;
                                                    }
                                                @endphp
                                                <td>{{ !empty($scores) ? number_format(floatval($scores), 2) : '' }}</td>
                                            @endforeach

                                            @if ($total_subjects_scored == $all_subjects)
                                                @php
                                                    $average = number_format($total_score / $all_subjects, 2);
                                                    if ($average > 8) {
                                                        $xep_loai = 'A';
                                                        $color = 'green';
                                                    } elseif ($average >= 6.5) {
                                                        $xep_loai = 'B';
                                                        $color = 'blue';
                                                    } elseif ($average >= 5) {
                                                        $xep_loai = 'C';
                                                        $color = 'orange';
                                                    } else {
                                                        $xep_loai = 'D';
                                                        $color = 'red';
                                                    }
                                                @endphp
                                                <td style="color:{{ $color }}">{{ $average }}</td>
                                                <td style="color:{{ $color }}">{{ $xep_loai }}</td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>


                    </form>
                </div>
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



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @endpush
@endsection
