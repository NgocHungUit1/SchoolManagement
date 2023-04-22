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
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Search by Name ...">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select" name="type">
                                            <option value="">Select Type</option>
                                            <option {{ Request::get('type') == 'Theory' ? 'selected' : '' }} value="Theory">
                                                Theory</option>
                                            <option {{ Request::get('type') == 'Practical' ? 'selected' : '' }}
                                                value="Practical">
                                                Practical</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="date"
                                            value="{{ Request::get('date') }}" placeholder="Search by Date ...">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="search-student-btn">
                                        <button id="filter" type="submit" class="btn btn-primary">Search</button>
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
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
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
                                            @foreach ($getRecord as $key => $value)
                                                <tr id="sid{{ $value->id }}">
                                                    <td>{{ $key + 1 }} </td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->type }}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                    <td>{{ $value->created_by_name }} </td>
                                                    <td>
                                                        @if ($value->status == 0)
                                                            <button style="width:85px" class="btn btn-success"
                                                                type="button"><i class="fe fe-check-verified"></i>
                                                                Active
                                                            </button>
                                                        @else
                                                            <button class="btn btn-danger" type="button"><i
                                                                    class="fe fe-check-verified"></i>
                                                                InActive
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="actions ">
                                                            <a href="javascript:void(0)"
                                                                onclick="deleteSubject({{ $value->id }})"
                                                                class="btn btn-sm bg-danger">
                                                                <i class="fa fa-trash " aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ url('admin/subject/edit/' . $value->id) }}"
                                                                class="btn btn-sm bg-danger-light">
                                                                <i class="feather-edit"></i>
                                                            </a>
                                                        </div>
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



    <script src="/../assets/js/jquery-3.6.0.min.js"></script>

    <script src="/../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/../assets/js/feather.min.js"></script>

    <script src="/../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="/../assets/plugins/datatables/datatables.min.js"></script>
    <script src="/../assets/js/script.js"></script>
@endsection
