@extends('layouts.app')
@section('content')
    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Edit Teacher Class</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                <li class="breadcrumb-item active"> Edit Teacher Class</li>
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

                                        <select class="form-control getClass" name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach ($getClass as $class)
                                                <option {{ $getRecord->class_id == $class->id ? 'selected' : '' }}
                                                    {{ Request::get('class_id') == $class->id ? 'selected' : '' }}
                                                    value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label>Subject Name <span class="login-danger">*</span></label>
                                        <select class="form-control getSubject" name="subject_id">
                                            <option value="">Select Subject </option>
                                            @if (!empty($getSubject))
                                                @foreach ($getSubject as $subject)
                                                    <option
                                                        {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}
                                                        value="{{ $subject->subject_id }}">
                                                        {{ $subject->subject_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                    <div class="form-group row">
                                        <label>Teacher Name <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="teacher_id">
                                            <option value="">Select Teacher</option>
                                            @foreach ($getTeacher as $teacher)
                                                <option {{ $getRecord->teacher_id == $teacher->id ? 'selected' : '' }}
                                                    value="{{ $teacher->id }}">{{ $teacher->name }}
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="form-group row">
                                        <label>Status <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="status">
                                            <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">Active
                                            </option>
                                            <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">InActive
                                            </option>
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
    @push('js')
        <script type="text/javascript">
            $('.getClass').change(function() {
                var class_id = $(this).val();

                $.ajax({
                    url: " {{ url('admin/assign_class_teacher/get_subject') }}",
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
