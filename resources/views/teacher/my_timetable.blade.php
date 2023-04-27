@extends('layouts.app')
@section('content')
    <div class="main-wrapper">


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="">Class Time Table</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Class Time Table</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive" id="user">
                    <h2 class="page-title">Class Name : {{ $getClass->name }}</h2>
                    <h2 class="page-title">Subject Name : {{ $getSubject->name }}</h2>
                    <table class="table border-0 star-student  table-striped">
                        <thead class="student-thread">
                            <tr>
                                <th>Day Of Week</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Class Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $valueday)
                                <tr>
                                    <td>
                                        {{ $valueday['day_name'] }}
                                    </td>
                                    <td>{{ !empty($valueday['start_time']) ? date('h:i A', strtotime($valueday['start_time'])) : '' }}
                                    </td>
                                    <td>{{ !empty($valueday['end_time']) ? date('h:i A', strtotime($valueday['end_time'])) : '' }}
                                    </td>
                                    <td>{{ $valueday['room_number'] }}</td>
                                </tr>
                            @endforeach
                            <br>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>



    </div>

    </div>



    <script type="text/javascript">
        $('.getClass').change(function() {
            var class_id = $(this).val();
            $.ajax({
                url: " {{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id: class_id,
                },
                dataType: "json",
                success: function(response) {
                    $('.getSubject').html(response.html);
                },
            });
        });
    </script>
@endsection
