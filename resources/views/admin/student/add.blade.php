@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Add Students</title>

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
                                    <h3 class="page-title">Add Students</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Add Students</li>
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
                                                <h5 class="form-title student-info">Student Information <span><a
                                                            href="javascript:;"><i
                                                                class="feather-more-vertical"></i></a></span></h5>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Full Name <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name"
                                                        placeholder="Enter First Name">
                                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Gender <span class="login-danger">*</span></label>
                                                    <select class="form-control select" name="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                    <div style="color:red">{{ $errors->first('gender') }}</div>

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms calendar-icon">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text"
                                                        name="date_of_birth">
                                                    <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Roll Number </label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Roll Number" value="{{ old('roll_number') }}"
                                                        name="roll_number">
                                                    <div style="color:red">{{ $errors->first('roll_number') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Class <span class="login-danger">*</span></label>
                                                    <select class="form-control select" name="class_id">
                                                        <option value="">Please Select Class </option>
                                                        @foreach ($getClass as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div style="color:red">{{ $errors->first('class_id') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Phone </label>
                                                    <input class="form-control" type="text" name="mobile_number"
                                                        placeholder="Enter Phone Number">
                                                    <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Status <span class="login-danger">*</span></label>
                                                    <select class="form-control select" name="status">
                                                        <option value="0">Active</option>
                                                        <option value="1">InActive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Address <span class="login-danger">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Enter address">
                                                    <div style="color:red">{{ $errors->first('address') }}</div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">

                                                <div class="form-group local-forms">
                                                    <label>E-Mail <span class="login-danger">*</span></label>

                                                    <input class="form-control" type="text"
                                                        value="{{ old('mail') }}" placeholder="Enter Email Address"
                                                        name="email">
                                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Password <span class="login-danger">*</span></label>

                                                    <input type="password" class="form-control" name="password">
                                                    <div style="color:red">{{ $errors->first('password') }}</div>
                                                </div>

                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group students-up-files">
                                                    <label>Upload Student Photo</label>
                                                    <div class="upload">
                                                        <label class="file-upload image-upbtn mb-0">
                                                            Choose File <input type="file" name="user_avatar">
                                                        </label>
                                                    </div>
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
