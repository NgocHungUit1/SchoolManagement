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
                                <h3 class="page-title">My Subject</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('student/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">All Subject</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                @foreach ($getExamSemester as $semester)
                    <div class="col-lg-6">
                        <div class="search-student-btn">
                            <button type="submit" class="btn btn-primary"
                                onclick="window.location.href='exam_schedule/{{ $semester->id }}'">{{ $semester->name }}</button>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>



    </div>

    </div>
@endsection
