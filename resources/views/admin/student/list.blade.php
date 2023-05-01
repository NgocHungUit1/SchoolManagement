@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Student</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">All Students</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="student-group-form">
                    <form action="" method="get">
                        <div class="row">



                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control name_search" name="name"
                                        value="{{ Request::get('name') }}" placeholder="Search by Name ...">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control class_search" name="class"
                                        value="{{ Request::get('class') }}" placeholder="Search by Class Name ...">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control mobile_number_search" name="mobile_number"
                                        value="{{ Request::get('mobile_number') }}"
                                        placeholder="Search by Moblie Phone ...">
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <div class="search-student-btn">
                                    <button type="button" onclick="handleSearch()" class="btn btn-primary">Search</button>
                                    <button type="button" onclick="handleReset()" class="btn btn-success"
                                        style=" padding: 10px;">RESET</button>
                                </div>
                            </div>
                    </form>
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
                                        <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                                class="feather-list"></i></a>
                                        <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                                class="feather-grid"></i></a>
                                        <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a>
                                        <a href="{{ url('admin/student/add') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 table-striped student_table">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Admission ID</th>
                                            <th>Roll Number</th>
                                            <th>full Name</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Moblie Number</th>
                                            <th>Email</th>
                                            <th>Create by Day</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


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
    <script type="text/javascript">
        function deleteStudent(id) {

            if (confirm("Do you want delete?")) {
                $.ajax({
                    url: 'delete/' + id,
                    type: 'GET',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {

                        $("#element" + id).parent().parent().parent().remove();
                    }
                });
            }
        }
    </script>
    @push('js')
        <script>
            $(document).ready(function() {
                var student_table = $('.student_table');
                var table = student_table.DataTable({
                    ajax: "/admin/student/getData",
                    columns: [{
                            data: "user_avatar"
                        },
                        {
                            data: "admission_number"
                        },
                        {
                            data: "roll_number"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "class_name"
                        },
                        {
                            data: "gender"
                        },
                        {
                            data: "date_of_birth"
                        },
                        {
                            data: "mobile_number"
                        },
                        {
                            data: "email"
                        },
                        {
                            data: "created_at"
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
                                return `<img class="rounded-circle" src="/public/uploads/profile/${full['user_avatar']} "height="100" width="100">`;
                            },
                        },
                        {
                            targets: 10,
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
                                      <a id="element${full['id']}" href="javascript:void(0)"
                                          onclick="deleteStudent(${full['id']})"
                                          class="btn btn-sm bg-danger">
                                          <i class="fa fa-trash " aria-hidden="true"></i>
                                      </a>
                                      <a href="/admin/student/edit/${full['id']}"
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
                const class_search = $(".class_search").val();
                const mobile_number_search = $(".mobile_number_search").val();
                var student_table = $('.student_table').DataTable();
                student_table.ajax.url(
                        `/admin/student/getData?name=${name}&class=${class_search}&mobile_number=${mobile_number_search}`)
                    .load();
                student_table.draw();
            }

            function handleReset() {
                const name = $(".name_search").val();
                const class_search = $(".class_search").val();
                const mobile_number_search = $(".mobile_number_search").val();
                var student_table = $('.student_table').DataTable();
                student_table.ajax.url(
                        `/admin/student/getData`)
                    .load();
                student_table.draw();
            }
        </script>
    @endpush
@endsection
