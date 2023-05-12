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
                                    <li class="breadcrumb-item"><a href="{{ url('teacher/dashboard') }}">Home</a></li>
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
                                        <h3 class="page-title">Student</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">



                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table class="table border-0 star-student table-hover table-center mb-0 table-striped ">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Admission ID</th>
                                            <th>Roll Number</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Moblie Number</th>
                                            <th>Email</th>
                                            <th>Create by Day</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr id="sid{{ $value->id }}">
                                                <td><img class="rounded-circle"
                                                        src="/public/uploads/profile/{{ $value->user_avatar }}"
                                                        height="100" width="100"></td>
                                                <td>{{ $value->admission_number }}</td>
                                                <td>{{ $value->roll_number }} </td>
                                                <td>{{ $value->name }} </td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->gender }} </td>
                                                <td>{{ date('d-m-Y ', strtotime($value->date_of_birth)) }} </td>
                                                <td>{{ $value->mobile_number }} </td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ date('d-m-Y ', strtotime($value->created_at)) }}</td>
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
    @push('js')
        <script>
            $(document).ready(function() {
                var subject_table = $('.subject_table');
                var table = subject_table.DataTable({
                    ajax: "/admin/subject/getData",
                    columns: [{
                            data: "id"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "type"
                        },
                        {
                            data: "created_at"
                        },
                        {
                            data: "created_by_name"
                        },
                        {
                            data: "status"
                        },
                        {
                            data: ""
                        },
                    ],
                    columnDefs: [{
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return `${full['id']}`;
                            },
                        },
                        {
                            targets: 5,
                            render: function(data, type, full, meta) {
                                if (full['status'] == 0) {
                                    return `<button style="width:85px" class="btn btn-success" type="button"><i
                                              class="fe fe-check-verified"></i>
                                          Active
                                      </button>`
                                } else {
                                    return `<button class = "btn btn-danger" type="button"> <i class = "fe fe-check-verified"></i>InActive</button>`
                                }
                            },
                        },
                        {
                            targets: -1,
                            render: function(data, type, full, meta) {
                                return ` <div class="actions ">
                                  <a href="javascript:void(0)"
                                      onclick="deleteSubject(${full['id']})"
                                      class="btn btn-sm bg-danger">
                                      <i class="fa fa-trash " aria-hidden="true"></i>
                                  </a>
                                  <a href="/admin/subject/edit/${full['id']}"
                                      class="btn btn-sm bg-danger-light">
                                      <i class="feather-edit"></i>
                                  </a>
                              </div>`;
                            },
                        },
                    ]
                });
            })

            function handleSearch() {
                const name = $(".name_search").val();
                const type_search = $(".type_search").val();

                var subject_table = $('.subject_table').DataTable();
                subject_table.ajax.url(
                        `/admin/subject/getData?name=${name}&type=${type_search}`)
                    .load();
                subject_table.draw();
            }

            function handleReset() {
                var subject_table = $('.subject_table').DataTable();
                subject_table.ajax.url(
                        `/admin/subject/getData`)
                    .load();
                subject_table.draw();
            }
        </script>
    @endpush
@endsection
