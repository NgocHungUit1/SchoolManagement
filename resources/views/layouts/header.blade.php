<div class="header">

    <div class="header-left">
        @if (Auth::user()->user_type == 1)
            <a href="{{ url('admin/dashboard') }}" class="logo">
                <img src="/./assets/img/logo.png" alt="Logo">
            </a>
        @elseif (Auth::user()->user_type == 2)
            <a href="{{ url('teacher/dashboard') }}" class="logo">
                <img src="/./assets/img/logo.png" alt="Logo">
            </a>
        @elseif (Auth::user()->user_type == 3)
            <a href="{{ url('student/dashboard') }}" class="logo">
                <img src="/./assets/img/logo.png" alt="Logo">
            </a>
        @endif
    </div>
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow new-user-menus">
            @if (Auth::user()->user_type == 1)
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle"
                            src="/public/uploads/profile/{{ Auth::user()->user_avatar }}"width="31"
                            alt="Soeng Souy">

                        <div class="user-text">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p class="text-muted mb-0">Administrator</p>
                        </div>
                    </span>
                </a>
            @elseif (Auth::user()->user_type == 2)
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle"
                            src="/public/uploads/profile/{{ Auth::user()->user_avatar }}"width="31"
                            alt="Soeng Souy">
                        <div class="user-text">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p class="text-muted mb-0">Teacher</p>
                        </div>
                    </span>
                </a>
            @elseif (Auth::user()->user_type == 3)
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle"
                            src="/public/uploads/profile/{{ Auth::user()->user_avatar }}"width="31"
                            alt="Soeng Souy">
                        <div class="user-text">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p class="text-muted mb-0">Student</p>
                        </div>
                    </span>
                </a>
            @endif

            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img class="rounded-circle"
                            src="/public/uploads/profile/{{ Auth::user()->user_avatar }}"width="31"
                            alt="Soeng Souy">
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>
                </div>
                @if (Auth::user()->user_type == 1)
                    <a class="dropdown-item" href="{{ url('admin/admin/profile') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                @elseif (Auth::user()->user_type == 2)
                    <a class="dropdown-item" href="{{ url('teacher/profile') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                @elseif (Auth::user()->user_type == 3)
                    <a class="dropdown-item" href="{{ url('student/profile') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                @endif

            </div>
        </li>

    </ul>

</div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                @if (Auth::user()->user_type == 1)
                    <li class=" {{ set_active(['admin/admin/list']) }}"><a href="{{ url('admin/admin/list') }}"
                            class=" {{ set_active(['admin/admin/list']) }}">
                            <i class="fas fa-user"></i><span>
                                Users</span></a>
                    </li>


                    <li class=" {{ set_active(['admin/teacher/list']) }}"><a href="{{ url('admin/teacher/list') }}"
                            class=" {{ set_active(['admin/teacher/list']) }}">
                            <i class="fas fa-graduation-cap"></i> <span>
                                Teachers</span></a>
                    </li>


                    <li class=" {{ set_active(['admin/student/list']) }}"><a href="{{ url('admin/student/list') }}"
                            class=" {{ set_active(['admin/student/list']) }}">
                            <i class="fas fa-chalkboard-teacher"></i> <span>
                                Students</span></a>
                    </li>


                    <li class=" {{ set_active(['admin/class/list']) }}"><a href="{{ url('admin/class/list') }}"
                            class=" {{ set_active(['admin/class/list']) }}">
                            <i class="fas fa-building"></i> <span>
                                Class</span></a>
                    </li>

                    <li class=" {{ set_active(['admin/subject/list']) }}"><a href="{{ url('admin/subject/list') }}"
                            class=" {{ set_active(['admin/subject/list']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                Subject</span></a>
                    </li>


                    <li class="submenu">
                        <a href="{{ url('admin/admin/list') }}"> <i class="fas fa-clipboard-list"></i> <span>
                                Exam</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li class=" {{ set_active(['admin/exam/list']) }}"><a href="{{ url('admin/exam/list') }}"
                                    class=" {{ set_active(['admin/exam/list']) }}">Exam List</a></li>
                            <li class=" {{ set_active(['admin/exam_schedule']) }}"><a
                                    href="{{ url('admin/exam_schedule') }}"
                                    class="{{ set_active(['admin/exam_schedule']) }}">Exam Schedule</a></li>
                            <li class=" {{ set_active(['admin/exam/score']) }}"><a
                                    href="{{ url('admin/exam/score') }}"
                                    class=" {{ set_active(['admin/exam/score']) }}">Exam Score</a></li>
                            <li class=" {{ set_active(['admin/academic']) }}"><a href="{{ url('admin/academic') }}"
                                    class=" {{ set_active(['admin/academic']) }}">Academic Record</a></li>

                        </ul>
                    </li>

                    <li class=" {{ set_active(['admin/assign_subject/list']) }}"><a
                            href="{{ url('admin/assign_subject/list') }}"
                            class=" {{ set_active(['admin/assign_subject/list']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                Assign Subjects</span></a>
                    </li>
                    <li class=" {{ set_active(['admin/assign_class_teacher/list']) }}"><a
                            href="{{ url('admin/assign_class_teacher/list') }}"
                            class=" {{ set_active(['admin/assign_class_teacher/list']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                Assign Teacher</span></a>
                    </li>

                    <li class=" {{ set_active(['admin/class_timetable/list']) }}"><a
                            href="{{ url('admin/class_timetable/list') }}"
                            class=" {{ set_active(['admin/class_timetable/list']) }}">
                            <i class="far fa-calendar"></i>
                            <span>
                                Class Time Table</span></a>
                    </li>
                @elseif (Auth::user()->user_type == 2)
                    <li class=" {{ set_active(['teacher/my-calendar']) }}"><a
                            href="{{ url('teacher/my-calendar/?semester_id=1') }}"
                            class=" {{ set_active(['teacher/my-calendar']) }}">
                            <i class="far fa-calendar"></i>
                            <span>
                                My Calendar</span></a>
                    </li>
                    <li class=" {{ set_active(['teacher/my_exam']) }}"><a
                            href="{{ url('teacher/my_exam/?semester_id=1') }}"
                            class=" {{ set_active(['teacher/my_exam/']) }}">
                            <i class="fas fa-clipboard-list"></i> <span>
                                Exam</span></a>
                    </li>
                    <li class=" {{ set_active(['teacher/exam_score']) }}"><a href="{{ url('teacher/exam_score') }}"
                            class=" {{ set_active(['teacher/exam_score']) }}">
                            <i class="fas fa-chalkboard"></i>
                            <span>
                                Academic Record</span></a>
                    </li>

                    <li class=" {{ set_active(['teacher/my-subject-class']) }}"><a
                            href="{{ url('teacher/my-subject-class') }}"
                            class=" {{ set_active(['teacher/my-subject-class']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                My Subject</span></a>
                    </li>
                    <li class=" {{ set_active(['teacher/my-student']) }}"><a href="{{ url('teacher/my-student') }}"
                            class=" {{ set_active(['teacher/my-student']) }}">
                            <i class="fas fa-chalkboard"></i>
                            <span>
                                My Class & Student</span></a>
                    </li>
                @elseif (Auth::user()->user_type == 3)
                    <li class=" {{ set_active(['student/my-calendar']) }}"><a
                            href="{{ url('student/my-calendar/?semester_id=1') }}"
                            class=" {{ set_active(['student/my-calendar']) }}">
                            <i class="far fa-calendar"></i>
                            </i> <span>
                                My Calendar</span></a>
                    </li>
                    <li class=" {{ set_active(['student/my-class']) }}"><a href="{{ url('student/my-class') }}"
                            class=" {{ set_active(['student/my-class']) }}">
                            <i class="fas fa-chalkboard"></i>
                            </i> <span>
                                My Class</span></a>
                    </li>
                    <li class=" {{ set_active(['student/my-exam']) }}"><a
                            href="{{ url('student/my-exam/?semester_id=1') }}"
                            class=" {{ set_active(['student/my-exam']) }}">
                            <i class="far fa-file-alt"></i>
                            </i> <span>
                                My Exam</span></a>
                    </li>
                    <li class=" {{ set_active(['student/my-subject']) }}"><a href="{{ url('student/my-subject') }}"
                            class=" {{ set_active(['student/my-subject']) }}">
                            <i class="fas fa-book"></i>
                            </i> <span>
                                Subject List</span></a>
                    </li>
                    <li class=" {{ set_active(['student/my-score']) }}"><a
                            href="{{ url('student/my-score/?semester_id=1') }}"
                            class=" {{ set_active(['student/my-score']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                Academic Record</span></a>
                    </li>
                    <li class=" {{ set_active(['student/my-timetable']) }}"><a
                            href="{{ url('student/my-timetable') }}"
                            class=" {{ set_active(['student/my-timetable']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                Class Time Table</span></a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
