@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Exam</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                            <li class="breadcrumb-item active">Add Exam</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Exam Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Exam Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div style="color:red">{{ $errors->first('name') }}</div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Class Name <span class="login-danger">*</span></label>
                                            <select class="form-control getClass" name="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($getClass as $class)
                                                    <option {{ Request::get('class_id') == $class->id ? 'selected' : '' }}
                                                        value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <div style="color:red">{{ $errors->first('class_id') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Subject <span class="login-danger">*</span></label>
                                            <select class="form-control getSubject" name="subject_id">
                                                <option value="">Select Subject </option>
                                                @if (!empty($getSubject))
                                                    @foreach ($getSubject as $subject)
                                                        <option
                                                            {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}
                                                            value="{{ $subject->subject_id }}">{{ $subject->subject_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div style="color:red">{{ $errors->first('subject_id') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="time" name="start_time" class="form-control">
                                            <div style="color:red">{{ $errors->first('start_time') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="time" name="end_time" class="form-control">
                                            <div style="color:red">{{ $errors->first('end_time') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Create Date</label>
                                            <input type="date" name="created_at" class="form-control">
                                        </div>
                                        <div style="color:red">{{ $errors->first('created_at') }}</div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group ">
                                            <label>Status <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="status">
                                                <option value="0">Active</option>
                                                <option value="1">InActive</option>
                                            </select>
                                        </div>
                                        <div style="color:red">{{ $errors->first('status') }}</div>
                                    </div>
                                    <div class="col-12">
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
    @push('js')
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
    @endpush
@endsection
