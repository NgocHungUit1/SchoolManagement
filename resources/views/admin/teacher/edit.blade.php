@extends('layouts.app')
@section('content')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Edit Teacher</title>

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
                                <h3 class="page-title">Edit Teachers</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Edit Teachers</li>
                                </ul>
                            </div>
                        </div>
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
                                                    <label>Teacher ID <span class="login-danger">*</span></label>
                                                    <input type="text" name="teacher_id" class="form-control"
                                                        placeholder="Teacher ID"
                                                        value="{{ old('teacher_id', $getRecord->teacher_id) }}" disabled>
                                                    <div style="color:red">{{ $errors->first('teacher_id') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Full Name <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name"
                                                        value="{{ old('name', $getRecord->name) }}"
                                                        placeholder="Enter Full Name">
                                                    <div style="color:red">{{ $errors->first('name') }}</div>
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
                                                <div style="color:red">{{ $errors->first('gender') }}</div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms calendar-icon">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text"
                                                        name="date_of_birth"
                                                        value="{{ old('date_of_birth', $getRecord->date_of_birth) }}">
                                                    <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
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
                                                <div class="form-group local-forms calendar-icon">
                                                    <label>Joining Date <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text"
                                                        value="{{ old('joining_date', $getRecord->joining_date) }}"
                                                        name="joining_date">
                                                    <div style="color:red">{{ $errors->first('joining_date') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 local-forms">
                                                <div class="form-group">
                                                    <label>Qualification <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="qualification"
                                                        value="{{ old('qualification', $getRecord->qualification) }}"
                                                        placeholder="Enter qualification ">
                                                    <div style="color:red">{{ $errors->first('qualification') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Experience <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="experience"
                                                        value="{{ old('experience', $getRecord->experience) }}"
                                                        placeholder="Enter Experience">

                                                    <div style="color:red">{{ $errors->first('experience') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Address <span class="login-danger">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ old('address', $getRecord->address) }}"
                                                        placeholder="Enter address">
                                                    <div style="color:red">{{ $errors->first('address') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h5 class="form-title"><span>Login Details</span></h5>
                                            </div>
                                            <div class="col-12 col-sm-4">

                                                <div class="form-group local-forms">
                                                    <label>E-Mail <span class="login-danger">*</span></label>

                                                    <input class="form-control" type="text"
                                                        value="{{ old('email', $getRecord->email) }}" disabled
                                                        placeholder="Enter Email Address" name="email">
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Password <span class="login-danger">*</span></label>
                                                    <input type="password" name="password" class="form-control"
                                                        value="{{ old('password', bcrypt($getRecord->password)) }}"
                                                        placeholder="Enter
                                                        Password">
                                                    <div style="color:red">{{ $errors->first('password') }}</div>
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

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Teacher's expertise <span class="login-danger">*</span></label>
                                                    <select class="form-control select" required name="subject_id">
                                                        <option>Please Select Subject </option>
                                                        @foreach ($getSubject as $value)
                                                            <option
                                                                {{ $getRecord->subject_id == $value->id ? 'selected' : '' }}
                                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div style="color:red">{{ $errors->first('subject_id') }}</div>
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="form-group students-up-files">
                                                    <h5 class="form-title"><span>Upload teacher avatar</span></h5>
                                                    <div class="upload">
                                                        <label class="file-upload image-upbtn mb-0">
                                                            Choose File <input type="file" name="user_avatar">
                                                        </label>
                                                    </div>
                                                    <img src="/public/uploads/profile/{{ $getRecord->user_avatar }}"
                                                        height="100" width="100">
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
    @endsection
