@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Exam Edit</title>

        <link rel="shortcut icon" href="/../assets/img/favicon.png">

        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
            rel="stylesheet">

        <link rel="stylesheet" href="/../assets/plugins/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" href="/../assets/plugins/feather/feather.css">

        <link rel="stylesheet" href="/../assets/plugins/icons/flags/flags.css">

        <link rel="stylesheet" href="/../assets/css/bootstrap-datetimepicker.min.css">

        <link rel="stylesheet" href="/../assets/plugins/fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="/../assets/plugins/fontawesome/css/all.min.css">

        <link rel="stylesheet" href="/../assets/plugins/select2/css/select2.min.css">

        <link rel="stylesheet" href="/../assets/css/style.css">
    </head>

    <body>

        <div class="main-wrapper">

            <div class="page-wrapper">
                <div class="content container-fluid">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <div class="page-sub-header">
                                    <h3 class="page-title">Edit Exam</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Edit Exam</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card comman-shadow">
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="form-title student-info">Exam Information <span><a
                                                            href="javascript:;"><i
                                                                class="feather-more-vertical"></i></a></span></h5>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Exam Name <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name"
                                                        value="{{ old('name', $getRecord->name) }}"
                                                        placeholder="Enter Full Name">
                                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Class <span class="login-danger">*</span></label>
                                                    <select class="form-control select" name="class_id">

                                                        @foreach ($getClass as $value)
                                                            <option
                                                                {{ $getRecord->class_id == $value->id ? 'selected' : '' }}
                                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div style="color:red">{{ $errors->first('class_id') }}</div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Subject Name <span class="login-danger">*</span></label>
                                                    <select class="form-control select" name="subject_id">

                                                        @foreach ($getSubject as $value)
                                                            <option
                                                                {{ $getRecord->subject_id == $value->id ? 'selected' : '' }}
                                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div style="color:red">{{ $errors->first('subject_id') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Start Time</label>
                                                    <input type="time" name="start_time"
                                                        value="{{ old('start_time', $getRecord->start_time) }}"
                                                        class="form-control">
                                                    <div style="color:red">{{ $errors->first('start_time') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>End Time</label>
                                                    <input type="time" name="end_time"
                                                        value="{{ old('end_time', $getRecord->end_time) }}"
                                                        class="form-control">
                                                    <div style="color:red">{{ $errors->first('end_time') }}</div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms calendar-icon">
                                                    <label>Created Date <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text"
                                                        value="{{ old('created_at', $getRecord->created_at) }}"
                                                        name="created_at">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Status <span class="login-danger">*</span></label>
                                                    <select class="form-control select" name="status">
                                                        <option {{ $getRecord->status == 0 ? 'selected' : '' }}
                                                            value="0">Active
                                                        </option>
                                                        <option {{ $getRecord->status == 1 ? 'selected' : '' }}
                                                            value="1">InActive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="student-submit">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <script src="/../assets/js/jquery-3.6.0.min.js"></script>

        <script src="/../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="/../assets/js/feather.min.js"></script>

        <script src="/../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="/../assets/plugins/select2/js/select2.min.js"></script>

        <script src="/../assets/plugins/moment/moment.min.js"></script>
        <script src="/../assets/js/bootstrap-datetimepicker.min.js"></script>

        <script src="/../assets/js/script.js"></script>
    </body>

    </html>
@endsection
