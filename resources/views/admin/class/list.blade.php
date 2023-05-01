@extends('layouts.app')
@section('content')
    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Class</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">All Class</li>
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
                            <div class="col-lg-2">
                                <div class="search-student-btn">
                                    <button type="button" onclick="handleSearch()" class="btn btn-primary">Search</button>
                                    <button type="button" onclick="handleReset()" class="btn btn-success">Reset</button>
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
                                        <h3 class="page-title">Class</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                                class="feather-list"></i></a>
                                        <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                                class="feather-grid"></i></a>
                                        <a href="{{ url('admin/class/export') }}" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Download</a>
                                        <a href="{{ url('admin/class/add') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0  table-striped class_table">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Create by Day</th>
                                            <th>Create by User</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
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
        function deleteClass(id) {

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
                var class_table = $('.class_table');
                var table = class_table.DataTable({
                    ajax: "/admin/class/getData",
                    columns: [{
                            data: "id"
                        }, {
                            data: "name"
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
                            targets: 4,
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
                                         onclick="deleteTeacher(${full['id']})"
                                         class="btn btn-sm bg-danger">
                                         <i class="fa fa-trash " aria-hidden="true"></i>
                                     </a>
                                     <a href="/admin/class/edit/${full['id']}"
                                         class="btn btn-sm bg-danger-light">
                                         <i class="feather-edit"></i>
                                     </a>
                                     <a href="/admin/class/view/${full['id']}"
                                         class="btn btn-sm bg-success-light me-2">
                                         <i class="feather-eye"></i>
                                     </a>
                                 </div>`;
                            },
                        },
                    ]
                });
            })

            function handleSearch() {
                const name = $(".name_search").val();
                const date_search = $(".date_search").val();
                var class_table = $('.class_table').DataTable();
                class_table.ajax.url(
                        `/admin/class/getData?name=${name}&class=${date_search}`)
                    .load();
                class_table.draw();
            }

            function handleReset() {
                const name = $(".name_search").val();
                const date_search = $(".date_search").val();
                var class_table = $('.class_table').DataTable();
                class_table.ajax.url(
                        `/admin/class/getData`)
                    .load();
                class_table.draw();
            }
        </script>
    @endpush
@endsection
