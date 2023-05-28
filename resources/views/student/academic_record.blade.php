@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>List User</title>
    <link rel="shortcut icon" href="/..//../assets/img/favicon.png">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/..//../assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/..//../assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="/..//../assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="/..//../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/..//../assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="/..//../assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="/..//../assets/css/style.css">
    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Academic Record</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('student/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Academic Record</li>
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
                                    <div class="student-group-form">
                                        <form action="" method="get">
                                            <div class="row">
                                                @include('_message')

                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <button type="submit" name="semester_id" value="1"
                                                            class="btn btn-primary {{ Request::get('semester_id') == 1 ? 'active' : '' }}">Học
                                                            kì 1</button>
                                                        <button type="submit" name="semester_id" value="2"
                                                            class="btn btn-primary {{ Request::get('semester_id') == 2 ? 'active' : '' }}">Học
                                                            kì 2</button>

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

                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Subject</th>
                                            @foreach ($getExam as $value)
                                                <th>{{ $value->exam_name }}</th>
                                            @endforeach
                                            <th>
                                                Average Score
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_subjects = count($getSubject);
                                            $total_score = 0;
                                            $all_exam = count($getExam);
                                            $average_score_count = 0;
                                        @endphp

                                        @foreach ($getSubject as $subject)
                                            <tr>
                                                <td>{{ $subject->subject_name }}</td>
                                                @php
                                                    $i = 1;
                                                    $total = 0;
                                                    $total_weight = 0;
                                                    $total_subjects_scored = 0;
                                                @endphp

                                                @foreach ($getExam as $exam)
                                                    @php
                                                        $score =
                                                            $getRecord
                                                                ->where('subject_id', $subject->subject_id)
                                                                ->where('exam_id', $exam->exam_id)
                                                                ->first()->score ?? '';
                                                        if (!empty($score)) {
                                                            $subtotal = $score * $exam->percent;
                                                            $total += $subtotal;
                                                            $total_subjects_scored++;
                                                            $total_weight += $exam->percent;
                                                        }
                                                    @endphp
                                                    <td>{{ $score }}</td>
                                                @endforeach

                                                @if ($total_subjects_scored == $all_exam)
                                                    @if ($total_weight > 0)
                                                        @php
                                                            $average_score_count++;
                                                            $average = $total / $total_weight;
                                                            $total_score += $average;
                                                        @endphp
                                                        @if ($average < 5)
                                                            <td style="color:crimson">
                                                                {{ !empty($average) ? number_format(floatval($average), 2) : '' }}
                                                            </td>
                                                        @else
                                                            <td> {{ !empty($average) ? number_format(floatval($average), 2) : '' }}
                                                            </td>
                                                        @endif
                                                    @endif
                                                @else
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach

                                        @if ($average_score_count === $total_subjects && $average_score_count > 0)
                                            <tr>
                                                <td>
                                                    <strong>Average:
                                                        {{ number_format(round($total_score / $total_subjects, 2), 2) }}</strong>
                                                </td>
                                                <td colspan="{{ count($getExam) }}"></td>
                                            </tr>
                                        @endif
                                        @foreach ($StudentScoreSemester as $value)
                                            <tr>
                                                <td>
                                                    <strong>Average year:
                                                        {{ $value->avage_score }}</strong>
                                                </td>
                                                <td>
                                                    <strong>Rank:
                                                        {{ $value->rank }}</strong>
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
@endsection
