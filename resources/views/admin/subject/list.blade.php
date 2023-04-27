@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>List User</title>
    <link rel="shortcut icon" href="/..//../assets/img/favicon.png">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/../assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/../assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="/../assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="/../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/../assets/plugins/datatables/datatables.min.css">
    <link rel="stylesheet" href="/../assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <div class="main-wrapper">
        <div class="main-wrapper">

            <div class="page-wrapper">
                <div class="content container-fluid">

                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-sub-header">
                                    <h3 class="page-title">Subject</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a>
                                        </li>
                                        <li class="breadcrumb-item active">All Subject</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="student-group-form">
                        <form action="" method="get">
                            <div class="row">
                                @include('_message')

                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control name_search" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Search by Name ...">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select type_search" name="type">
                                            <option value="">Select Type</option>
                                            <option {{ Request::get('type') == 'Theory' ? 'selected' : '' }} value="Theory">
                                                Theory</option>
                                            <option {{ Request::get('type') == 'Practical' ? 'selected' : '' }}
                                                value="Practical">
                                                Practical</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="search-student-btn">
                                        <button type="button" onclick="handleSearch()"
                                            class="btn btn-primary">Search</button>
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

                                <div class="page-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="page-title">Subject </h3>

                                        </div>
                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                                    class="feather-list"></i></a>
                                            <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                                    class="feather-grid"></i></a>
                                            <a href="#" class="btn btn-outline-primary me-2"><i
                                                    class="fas fa-download"></i> Download</a>
                                            <a href="{{ url('admin/subject/add') }}" class="btn btn-primary"><i
                                                    class="fas fa-plus"></i> </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive" id="user">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0  table-striped subject_table">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Create by Day</th>
                                                <th>Create by User</th>
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
        function deleteSubject(id) {

            if (confirm("Do you want delete?")) {
                $.ajax({
                    url: 'delete/' + id,
                    type: 'GET',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {

                        $("#sid" + id).remove();
                    }
                });
            }
        }
    </script>
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
