@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Student</title>
    <link rel="shortcut icon" href="/..//../assets/img/favicon.png">


    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">My Class</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">My Class</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            @include('_message')
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">My Class</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">



                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped ">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Class</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr id="sid{{ $value->id }}">
                                                <td>{{ $value->name }}</td>
                                                <td>

                                                    @if ($value->status == 0)
                                                        <button style="width:85px" class="btn btn-success" type="button"><i
                                                                class="fe fe-check-verified"></i>
                                                            Active
                                                        </button>
                                                    @else
                                                        <button class="btn btn-danger" type="button"><i
                                                                class="fe fe-check-verified"></i>
                                                            InActive
                                                        </button>
                                                    @endif

                                                </td>
                                                <td> <a href="{{ url('admin/academic_record/' . $value->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-eye"></i>
                                                    </a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
