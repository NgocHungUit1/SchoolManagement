@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Welcome {{ Auth::user()->name }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ Auth::user()->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Students</h6>
                                    <h3>{{ $getStudent->count() }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="/./assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Teachers</h6>
                                    <h3>{{ $getTeacher->count() }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="/./assets/img/icons/dash-icon-02.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Class</h6>
                                    <h3>{{ $getClass->count() }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="/./assets/img/icons/dash-icon-03.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Subjects</h6>
                                    <h3>{{ $getSubject->count() }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="/./assets/img/icons/dash-icon-04.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-6">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Overview</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span>Teacher</li>
                                        <li><span class="circle-green"></span>Student</li>
                                        <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="donut"></div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-lg-6">



                    <div class="card flex-fill student-space comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title">Star Students</h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table star-student table-hover table-center table-borderless table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th class="text-center">Class</th>
                                            <th class="text-center">Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getStudentStar as $key => $student)
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>{{ $key++ }}</div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <a href="profile.html">
                                                        <img class="rounded-circle"
                                                            src="{{ URL::to('/public/uploads/profile/' . $student->user_avatar) }}"
                                                            width="25">
                                                        {{ $student->name }}
                                                    </a>
                                                </td>
                                                <td class="text-center">{{ $student->class_name }}</td>
                                                <td class="text-center">{{ $student->score }}</td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 d-flex">

                    <div class="card flex-fill student-space comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title">Statistical access</h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>User Online</th>
                                            <th>Last month's total</th>
                                            <th>This month's total</th>
                                            <th>This year's total</th>
                                            <th>Total hits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="color: antiquewhite;">
                                            <td>{{ $visitor_counts }}
                                            </td>
                                            <td>{{ $visitor_lastmonth_count }}</td>
                                            <td>{{ $visitor_thismonth_count }}</td>
                                            <td>{{ $visitor_thisyear_count }}</td>
                                            <td>{{ $visitor_total }}</td>


                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-6 d-flex">

                    <div class="card flex-fill comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title ">Student Activity </h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="activity-groups">
                                <div class="activity-awards">
                                    <div class="award-boxs">
                                        <img src="/./assets/img/icons/award-icon-01.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>1st place in "Chess”</h4>
                                        <h5>John Doe won 1st place in "Chess"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>1 Day ago</span>
                                    </div>
                                </div>
                                <div class="activity-awards">
                                    <div class="award-boxs">
                                        <img src="/./ssets/img/icons/award-icon-02.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>Participated in "Carrom"</h4>
                                        <h5>Justin Lee participated in "Carrom"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>2 hours ago</span>
                                    </div>
                                </div>
                                <div class="activity-awards">
                                    <div class="award-boxs">
                                        <img src="/./assets/img/icons/award-icon-03.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>Internation conference in "St.John School"</h4>
                                        <h5>Justin Leeattended internation conference in "St.John School"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>2 Week ago</span>
                                    </div>
                                </div>
                                <div class="activity-awards mb-0">
                                    <div class="award-boxs">
                                        <img src="/./assets/img/icons/award-icon-04.svg" alt="Award">
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>Won 1st place in "Chess"</h4>
                                        <h5>John Doe won 1st place in "Chess"</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>3 Day ago</span>
                                    </div>
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
                var colorDanger = "#FF1744";
                Morris.Donut({
                    element: 'donut',
                    resize: true,
                    colors: [
                        '#4287f5',
                        '#f54242',
                        '#cb42f5',
                        '#f542b9',
                    ],
                    //labelColor:"# cccccc ", // text color
                    //backgroundColor: '#333333', // border color
                    data: [{
                            label: "Student",
                            value: {{ $getStudent->count() }}
                        },
                        {
                            label: "Teacher",
                            value: {{ $getTeacher->count() }}
                        },
                        {
                            label: "Subject",
                            value: {{ $getSubject->count() }}
                        },
                        {
                            label: "Class",
                            value: {{ $getClass->count() }}
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
