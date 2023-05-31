@extends('layouts.app')
@section('content')
    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Assign Subject Class</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">All Assign Subject Class</li>
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
                                    <input type="text" class="form-control class_name " name="class_name"
                                        value="{{ Request::get('class_name') }}" placeholder="Search by Class Name ...">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control subject_name" name="subject_name"
                                        value="{{ Request::get('subject_name') }}" placeholder="Search by Subject Name ...">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control teacher_name" name="teacher_name"
                                        value="{{ Request::get('teacher_name') }}" placeholder="Search by Teacher Name ...">
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
                                        <h3 class="page-title">Subject</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">

                                        <a href="{{ url('admin/assign_class_teacher/add') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" id="user">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 table-striped assign_subject">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Teacher Name</th>
                                            <th>Create by User</th>
                                            <th>Create Date</th>
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
        function deleteItem(id) {

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
                var assign_subject = $('.assign_subject');
                var table = assign_subject.DataTable({
                    ajax: "/admin/assign_class_teacher/getData",
                    columns: [{
                            data: "id"
                        },
                        {
                            data: "classroom.name"
                        },
                        {
                            data: "subject.name"
                        },
                        {
                            data: "teacher.name"
                        },
                        {
                            data: "created_by.name"
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
                                return `${full['id']}`;
                            },
                        },
                        {
                            targets: 6,
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
                                     onclick="deleteItem(${full['id']})"
                                     class="btn btn-sm bg-danger">
                                     <i class="fa fa-trash " aria-hidden="true"></i>
                                 </a>
                                 <a href="/admin/assign_class_teacher/edit/${full['id']}"
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
                const class_name = $(".class_name").val();
                const subject_name = $(".subject_name").val();
                const teacher_name = $(".teacher_name").val();
                var assign_subject = $('.assign_subject').DataTable();
                assign_subject.ajax.url(
                        `/admin/assign_class_teacher/getData?class_name=${class_name}&subject_name=${subject_name}&teacher_name=${teacher_name}`
                    )
                    .load();
                assign_subject.draw();
            }

            function handleReset() {
                var assign_subject = $('.assign_subject').DataTable();
                assign_subject.ajax.url(
                        `/admin/assign_class_teacher/getData`)
                    .load();
                assign_subject.draw();
            }
        </script>
    @endpush
@endsection
