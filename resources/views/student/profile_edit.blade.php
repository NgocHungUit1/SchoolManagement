@extends('layouts.app')
@section('content')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Add Teacher</title>

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

    <body>

        <div class="main-wrapper">
            <div class="page-wrapper">
                <div class="content container-fluid">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Edit Student</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('student/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Edit Student</li>
                                </ul>
                            </div>
                        </div>
                        @include('_message')
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="form-title"><span>Basic Details</span></h5>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Full Name <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name"
                                                        value="{{ old('name', $getRecord->name) }}"
                                                        placeholder="Enter Full Name">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Addmission Number<span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="admission_number"
                                                        value="{{ old('name', $getRecord->admission_number) }}"
                                                        placeholder="Admission Number">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Roll Number<span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="roll_number"
                                                        value="{{ old('name', $getRecord->roll_number) }}"
                                                        placeholder="Roll Number">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Gender <span class="login-danger">*</span></label>
                                                    <select class="form-control select" name="gender">
                                                        <option>Select Gender</option>
                                                        <option {{ $getRecord->gender == 'Female' ? 'selected' : '' }}
                                                            value="Female">Female</option>
                                                        <option {{ $getRecord->gender == 'Male' ? 'selected' : '' }}
                                                            value="Male">Male</option>
                                                        <option {{ $getRecord->gender == 'Others' ? 'selected' : '' }}
                                                            value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Class <span class="login-danger">*</span></label>
                                                    <select class="form-control select" required name="class_id">
                                                        <option>Please Select Class </option>
                                                        @foreach ($getClass as $value)
                                                            <option
                                                                {{ $getRecord->class_id == $value->id ? 'selected' : '' }}
                                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach

                                                    </select>

                                                    <div style="color:red">{{ $errors->first('class_id') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms calendar-icon">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text"
                                                        value="{{ old('date_of_birth', $getRecord->date_of_birth) }}"
                                                        name="date_of_birth">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Phone </label>
                                                    <input class="form-control" type="text" name="mobile_number"
                                                        value="{{ old('mobile_number', $getRecord->mobile_number) }}"
                                                        placeholder="Enter Phone Number">
                                                    <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Address <span class="login-danger">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ old('address', $getRecord->address) }}"
                                                        placeholder="Enter address">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Email ID <span class="login-danger">*</span></label>
                                                    <input type="email" name="email"class="form-control"
                                                        value="{{ old('email', $getRecord->email) }}"
                                                        placeholder="Enter Mail Id">
                                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-5">
                                                <div class="form-group students-up-files">
                                                    <h5 class="form-title"><span>Upload teacher avatar</span></h5>
                                                    <div class="upload">
                                                        <label class="file-upload image-upbtn mb-0">
                                                            Choose File <input type="file" name="user_avatar">
                                                        </label>
                                                    </div>
                                                </div>
                                                <img src="/public/uploads/profile/{{ $getRecord->user_avatar }}"
                                                    height="100" width="100">
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
    @endsection
