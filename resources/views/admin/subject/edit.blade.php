@extends('layouts.app')
@section('content')
    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Edit Subject</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                <li class="breadcrumb-item active">Edit Subject</li>
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
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Enter Name Class">
                                        <div style="color:red">{{ $errors->first('name') }}</div>
                                    </div>
                                    <div class="form-group row">
                                        <label>Subject Type <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="type">
                                            <option {{ $getRecord->type == 'Theory' ? 'selected' : '' }} value="Theory">
                                                Theory</option>
                                            <option {{ $getRecord->type == 'Practical' ? 'selected' : '' }}
                                                value="Practical">
                                                Practical</option>
                                        </select>
                                    </div>


                                    <div class="form-group row">
                                        <label>Status <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="status">
                                            <option {{ $getRecord->status == '0' ? 'selected' : '' }} value="0">
                                                Active</option>
                                            <option {{ $getRecord->status == '1' ? 'selected' : '' }} value="1">
                                                InActive</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-primary">Edit</button>
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
