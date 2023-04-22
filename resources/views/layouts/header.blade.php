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

    <div class="top-nav-search">
        <form>
            <input type="text" class="form-control" placeholder="Search here">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>

    <ul class="nav user-menu">
        <li class="nav-item dropdown noti-dropdown language-drop me-2">
            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="/./assets/img/icons/header-icon-01.svg" alt="">
            </a>
            <div class="dropdown-menu ">
                <div class="noti-content">

                </div>
            </div>
        </li>

        <li class="nav-item dropdown noti-dropdown me-2">
            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="/./assets/img/icons/header-icon-05.svg" alt="">
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="#">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img class="avatar-img rounded-circle" alt="User Image"
                                            src="/./assets/img/profiles/avatar-02.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                            approved <span class="noti-title">your estimate</span></p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="#">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img class="avatar-img rounded-circle" alt="User Image"
                                            src="/./assets/img/profiles/avatar-11.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">International Software
                                                Inc</span> has sent you a invoice in the amount of <span
                                                class="noti-title">$218</span></p>
                                        <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="#">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img class="avatar-img rounded-circle" alt="User Image"
                                            src="/./assets/img/profiles/avatar-17.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">John Hendry</span>
                                            sent
                                            a cancellation request <span class="noti-title">Apple iPhone
                                                XR</span></p>
                                        <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="#">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img class="avatar-img rounded-circle" alt="User Image"
                                            src="/./assets/img/profiles/avatar-13.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Mercury Software
                                                Inc</span> added a new product <span class="noti-title">Apple
                                                MacBook Pro</span></p>
                                        <p class="noti-time"><span class="notification-time">12 mins
                                                ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>
            </div>
        </li>

        <li class="nav-item zoom-screen me-2">
            <a href="#" class="nav-link header-nav-list win-maximize">
                <img src="/./assets/img/icons/header-icon-04.svg" alt="">
            </a>
        </li>

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
                    <a class="dropdown-item" href="inbox.html">Inbox</a>
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                @elseif (Auth::user()->user_type == 2)
                    <a class="dropdown-item" href="{{ url('teacher/profile') }}">My Profile</a>
                    <a class="dropdown-item" href="inbox.html">Inbox</a>
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                @elseif (Auth::user()->user_type == 3)
                    <a class="dropdown-item" href="{{ url('student/profile') }}">My Profile</a>
                    <a class="dropdown-item" href="inbox.html">Inbox</a>
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
                    <li class="submenu active">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="index.html" class="active">Admin Dashboard</a></li>
                            <li><a href="teacher-dashboard.html">Teacher
                                    Dashboard</a></li>
                            <li><a href="student-dashboard.html">Student Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('admin/admin/list') }}"><i class="fas fa-user"></i> <span> User</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/admin/list') }}">User List</a></li>
                            <li><a href="student-details.html">User View</a></li>
                            <li><a href="{{ url('admin/admin/add') }}">User Add</a></li>
                            <li><a href="edit-student.html">User Edit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/student/list') }}">Student List</a></li>
                            <li><a href="student-details.html">Student View</a></li>
                            <li><a href="{{ url('admin/student/add') }}">Student Add</a></li>
                            <li><a href="edit-student.html">Student Edit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/teacher/list') }}">Teacher List</a></li>
                            <li><a href="teacher-details.html">Teacher View</a></li>
                            <li><a href="{{ url('admin/teacher/add') }}">Teacher Add</a></li>
                            <li><a href="edit-teacher.html">Teacher Edit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('admin/class/list') }}"><i class="fas fa-building"></i> <span>
                                Class</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/class/list') }}">Class List</a></li>
                            <li><a href="{{ url('admin/class/add') }}">Class Add</a></li>
                            <li><a href="edit-department.html">Class Edit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('admin/subject/list') }}"><i class=" fas fa-book-reader"></i>
                            <span>
                                Subjects</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/subject/list') }}">Subject List</a></li>
                            <li><a href="add-subject.html">Subject Add</a></li>
                            <li><a href="edit-subject.html">Subject Edit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('admin/exam/list') }}"><i class="fas fa-clipboard-list"></i> <span>Exam
                                list</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/exam/list') }}">Exam List</a></li>
                            <li><a href="add-subject.html">Exam Add</a></li>
                            <li><a href="edit-subject.html">Exam Edit</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="{{ url('admin/assign_subject/list') }}"><i class=" fas fa-book-reader"></i>
                            <span>
                                Assign Subjects</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/assign_subject/list') }}">Subject List</a></li>
                            <li><a href="add-subject.html">Subject Add</a></li>
                            <li><a href="edit-subject.html">Subject Edit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('admin/assign_class_teacher/list') }}"><i class=" fas fa-book-reader"></i>
                            <span>
                                Assign Class Teacher</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/assign_class_teacher/list') }}">Assign Class Teacher
                                    List</a>
                            </li>
                            <li><a href="{{ url('admin/assign_class_teacher/add') }}">Assign Class Teacher Add</a>
                            </li>
                            <li><a href="edit-subject.html">Subject Edit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="{{ url('admin/class_timetable/list') }}"><i class=" fas fa-book-reader"></i>
                            <span>
                                Class Time Table</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/class_timetable/list') }}"> Class Time Table
                                    List</a>
                            </li>
                            <li><a href="{{ url('admin/assign_class_teacher/add') }}">Assign Class Teacher Add</a>
                            </li>
                            <li><a href="edit-subject.html">Subject Edit</a></li>
                        </ul>
                    </li>
                @elseif (Auth::user()->user_type == 2)
                    <li class="submenu active">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="index.html" class="active">Admin Dashboard</a></li>
                            <li><a href="teacher-dashboard.html">Teacher
                                    Dashboard</a></li>
                            <li><a href="student-dashboard.html">Student Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="submenu active">
                    <li><a href="{{ url('teacher/my-subject-class') }}"> My Class Subject </a></li>
                    </li>
                    <li class="submenu active">
                    <li><a href="{{ url('teacher/my-student') }}">My Student</a></li>
                    </li>
                @elseif (Auth::user()->user_type == 3)
                    <li class="submenu active">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="index.html" class="active">Admin Dashboard</a></li>
                            <li><a href="teacher-dashboard.html">Teacher
                                    Dashboard</a></li>
                            <li><a href="student-dashboard.html">Student Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="submenu active">
                    <li><a href="{{ url('student/my-subject') }}">Subject List</a></li>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
