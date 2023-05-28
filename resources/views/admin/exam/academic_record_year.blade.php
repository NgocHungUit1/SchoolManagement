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
                                                href="{{ url('admin/academic_record/' . $getClass->id . '/1') }}"
                                                class="btn btn-primary ">HK1
                                            </a>
                                            <a style="color: white"
                                                href="{{ url('admin/academic_record/' . $getClass->id . '/2') }}"
                                                class="btn btn-primary ">HK2
                                            </a>
                                            <a style="color: white"
                                                href="{{ url('admin/academic_record_year/' . $getClass->id) }}"
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
                                    <th>Average Score 1</th>
                                    <th>Average Score 2</th>
                                    <th>Average Score CN</th>
                                    <th>Classification</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($getStudent) && !empty($getStudent->count()))
                                    @foreach ($getStudent as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $studentAverages[$student->id]['semester_1_average'] ?? '' }}</td>
                                            <td>{{ $studentAverages[$student->id]['semester_2_average'] ?? '' }}</td>
                                            <td>{{ $studentAverages[$student->id]['yearly_average'] ?? '' }}</td>
                                            @php
                                                $rank = $studentAverages[$student->id]['rank'] ?? '';
                                                $color = '';
                                                if ($rank === 'A') {
                                                    $color = 'green';
                                                } elseif ($rank === 'B') {
                                                    $color = 'blue';
                                                } elseif ($rank === 'C') {
                                                    $color = 'orange';
                                                } elseif ($rank === 'D') {
                                                    $color = 'red';
                                                }
                                            @endphp
                                            <td style="color:{{ $color }}">{{ $rank }}</td>
                                        </tr>
                                    @endforeach
                                    </tr>
                                @endif
                            </tbody>
                        </table>


                    </form>
                </div>



            </div>

        </div>



    </div>



    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @endpush
@endsection
