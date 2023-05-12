@extends('layouts.app')
@section('content')
    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Exam List</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Exam List</li>
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
                                    <input type="text" class="form-control exam" name="exam"
                                        value="{{ Request::get('exam_name') }}" placeholder="Search by Exam Name ...">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="search-student-btn">
                                    <button type="button" onclick="handleSearch()" class="btn btn-primary">Search</button>
                                    <button type="button" onclick="handleReset()" class="btn btn-success"
                                        style=" padding: 10px;">Reset</button>
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
                                        <h3 class="page-title">Exam</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">

                                        <a href="{{ url('admin/exam/add') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0  table-striped exam_table">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Exam Name</th>
                                            <th>Description</th>
                                            <th>Create by User</th>
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
        function deleteExam(id) {

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
                var exam_table = $('.exam_table');
                var table = exam_table.DataTable({
                    ajax: "/admin/exam/getData",
                    columns: [{
                            data: "id"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "description"
                        },
                        {
                            data: "created_by_name"
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
                            targets: -1,
                            render: function(data, type, full, meta) {
                                return ` <div class="actions ">
                                    <a id="element${full['id']}" href="javascript:void(0)"
                                        onclick="deleteExam(${full['id']})"
                                        class="btn btn-sm bg-danger">
                                        <i class="fa fa-trash " aria-hidden="true"></i>
                                    </a>
                                    <a href="/admin/exam/edit/${full['id']}"
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
                const class_name = $(".class").val();
                const subject_name = $(".subject").val();
                const exam_name = $(".exam").val();
                var exam_table = $('.exam_table').DataTable();
                exam_table.ajax.url(
                        `/admin/exam/getData?class=${class_name}&subject=${subject_name}&exam=${exam_name}`)
                    .load();
                exam_table.draw();
            }

            function handleReset() {
                var exam_table = $('.exam_table').DataTable();
                exam_table.ajax.url(
                        `/admin/exam/getData`)
                    .load();
                exam_table.draw();
            }
        </script>
    @endpush
@endsection
