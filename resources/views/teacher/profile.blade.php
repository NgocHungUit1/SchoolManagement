<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>My Profile</title>

    <link rel="shortcut icon" href="/./assets/img/favicon.png">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/./assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/./assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="/./assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="/./assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/./assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="/./assets/css/style.css">
</head>
@extends('layouts.app')
@section('content')

    <body>

        <div class="main-wrapper">

            <div class="page-wrapper">
                <div class="content container-fluid">

                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Profile</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('teacher/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-header">
                                <div class="row align-items-center">
                                    <div class="col-auto profile-image">
                                        <a href="#">
                                            <img class="rounded-circle"
                                                src="/public/uploads/profile/{{ $getRecord->user_avatar }}">
                                        </a>
                                    </div>
                                    <div class="col ms-md-n2 profile-user-info">
                                        <h4 class="user-name mb-0">{{ $getRecord->name }}</h4>
                                        <h6 class="text-muted">{{ $getRecord->qualification }}</h6>
                                        <div class="user-Location"><i class="fas fa-map-marker-alt"></i>
                                            {{ $getRecord->address }}</div>
                                    </div>
                                    <div class="col-auto profile-btn">
                                        <a href="{{ url('teacher/profile-edit') }}" class="btn btn-primary">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-menu">
                                <ul class="nav nav-tabs nav-tabs-solid">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content profile-tab-cont">

                                <div class="tab-pane fade show active" id="per_details_tab">

                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span>Personal Details</span>
                                                        @include('_message')
                                                        <a class="edit-link" data-bs-toggle="modal"
                                                            href="{{ url('teacher/profile-edit') }}"><i
                                                                class="far fa-edit me-1"></i>Edit</a>
                                                    </h5>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Full Name
                                                        </p>
                                                        <p class="col-sm-9">{{ $getRecord->name }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of
                                                            Birth</p>
                                                        <p class="col-sm-9">{{ $getRecord->date_of_birth }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Joining Date
                                                        </p>
                                                        <p class="col-sm-9">{{ $getRecord->joining_date }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email
                                                        </p>
                                                        <p class="col-sm-9"><a href="/cdn-cgi/l/email-protection"
                                                                class="__cf_email__"
                                                                data-cfemail="a1cbcec9cfc5cec4e1c4d9c0ccd1cdc48fc2cecc">{{ $getRecord->email }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">
                                                            Phone Number </p>
                                                        <p class="col-sm-9">{{ $getRecord->mobile_number }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                        <p class="col-sm-9 mb-0"> {{ $getRecord->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">

                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span>Account Status</span>
                                                        <a class="edit-link" href="#"><i class="far fa-edit me-1"></i>
                                                            Edit</a>
                                                    </h5>
                                                    <button class="btn btn-success" type="button"><i
                                                            class="fe fe-check-verified"></i>
                                                        @if ($getRecord->status == 0)
                                                            Active
                                                        @else
                                                            Inactive
                                                        @endif
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span>Skills </span>
                                                        <a class="edit-link" href="#"><i
                                                                class="far fa-edit me-1"></i> Edit</a>
                                                    </h5>
                                                    <div class="skill-tags">
                                                        <span>Html5</span>
                                                        <span>CSS3</span>
                                                        <span>WordPress</span>
                                                        <span>Javascript</span>
                                                        <span>Android</span>
                                                        <span>iOS</span>
                                                        <span>Angular</span>
                                                        <span>PHP</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div id="password_tab" class="tab-pane fade">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Change Password</h5>
                                            <div class="row">
                                                <div class="col-md-10 col-lg-6">
                                                    <form action="" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Old Password</label>
                                                            <input type="password" name="old_password"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input type="password" name="new_password"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <input type="password" name="confirm_password"
                                                                class="form-control">
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Save
                                                            Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="/./assets/js/jquery-3.6.0.min.js"></script>

        <script src="/./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="/./assets/js/feather.min.js"></script>

        <script src="/./assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="/./assets/js/script.js"></script>
    </body>

    </html>
@endsection
