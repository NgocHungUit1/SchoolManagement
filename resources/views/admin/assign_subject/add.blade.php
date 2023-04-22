@extends('layouts.app')
@section('content')
    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Add subject Class</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                <li class="breadcrumb-item active">Add subject Class</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post">
                                    @csrf

                                    <div class="form-group row">
                                        <label>Class Name <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach ($getClass as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label>Subject Name <span class="login-danger">*</span></label>
                                        @foreach ($getSubject as $subject)
                                            <div>
                                                <label>
                                                    <input type="checkbox" value="{{ $subject->id }}"
                                                        name="subject_id[]">{{ $subject->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="form-group row">
                                        <label>Status <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="status">
                                            <option value="0">Active</option>
                                            <option value="1">InActive</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
