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
    <div class="menu-toggle">
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>
    </div>


    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>

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
                    <li class="submenu ">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>

                    </li>
                    <li class="submenu">
                        <a href="{{ url('admin/admin/list') }}"><i class="fas fa-user"></i> <span> User</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/admin/list') }}">User List</a></li>
                            <li><a href="{{ url('admin/admin/add') }}">User Add</a></li>
                        </ul>
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
                    <li class=" {{ set_active(['admin/exam/list']) }}"><a href="{{ url('admin/exam/list') }}"
                            class=" {{ set_active(['admin/exam/list']) }}">
                            <i class="fas fa-clipboard-list"></i> <span>
                                Exam</span></a>
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
                                Assign Class Teacher</span></a>
                    </li>

                    <li class=" {{ set_active(['admin/class_timetable/list']) }}"><a
                            href="{{ url('admin/class_timetable/list') }}"
                            class=" {{ set_active(['admin/class_timetable/list']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                Class Time Table</span></a>
                    </li>
                @elseif (Auth::user()->user_type == 2)
                    <li class="">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span></span></a>

                    </li>
                    <li class=" {{ set_active(['teacher/exam/list']) }}"><a href="{{ url('teacher/exam/list') }}"
                            class=" {{ set_active(['teacher/exam/list']) }}">
                            <i class="fas fa-clipboard-list"></i> <span>
                                Exam</span></a>
                    </li>

                    <li class=" {{ set_active(['teacher/my-subject-class']) }}"><a
                            href="{{ url('teacher/my-subject-class') }}"
                            class=" {{ set_active(['teacher/my-subject-class']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                My Subject</span></a>
                    </li>
                    <li class=" {{ set_active(['teacher/my-student']) }}"><a href="{{ url('teacher/my-student') }}"
                            class=" {{ set_active(['teacher/my-student']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                My Class</span></a>
                    </li>
                @elseif (Auth::user()->user_type == 3)
                    <li class="submenu ">
                        <a href="#"><i></i> <span> Dashboard</span> <span></span></a>

                    </li>
                    <li class=" {{ set_active(['student/my-subject']) }}"><a href="{{ url('student/my-subject') }}"
                            class=" {{ set_active(['student/my-subject']) }}">
                            <i class="fas fa-book-reader"></i> <span>
                                Subject List</span></a>
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
