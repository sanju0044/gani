<div class="left-side-bar">
    <div class="brand-logo">
         <a href="{{url('/')}}">
            <center>
                <img src="{{asset('public/images/ganitalay.gif')}}" class="ganitalay-logo" style="width:60%;">
            </center>
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        @if(Auth::check())
        <div class="sidebar-menu">
            <ul>
                {{-- ADMIN MENU (user_type==1) --}}
                @if(Auth::user()->user_type==1)
                    <li>
                        <a href="{{url('admin/dashboard')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-tachometer-alt"></i></span><span class="mtext">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/students')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-user-graduate"></i></span><span class="mtext">Students</span> </a>
                    </li>
                    <li>
                        <a href="{{url('admin/mentors')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-chalkboard-teacher"></i></span><span class="mtext">Mentors</span> </a>
                    </li>
                    <li>
                        <a href="{{url('admin/moderators')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-shield-alt"></i></span><span class="mtext">Moderator</span> </a>
                    </li>
                    <li>
                        <a href="{{url('admin/Video-Conference/list')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-video"></i></span><span class="mtext">Video Conference</span> </a>
                    </li>
                    <li>
                        <a href="{{url('admin/content-approval')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-check-circle"></i></span><span class="mtext">Content Approval</span> </a>
                    </li>
                    <li>
                        <a href="{{url('admin/activity-logs')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-clipboard-list"></i></span><span class="mtext">Activity Logs</span> </a>
                    </li>

                {{-- MODERATOR MENU (user_type==2) --}}
                @elseif(Auth::user()->user_type==2)
                    <li>
                        <a href="{{url('admin/dashboard')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-tachometer-alt"></i></span><span class="mtext">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/Video-Conference/list')}}" class="dropdown-toggle">
                            <span class="micon"><i class="fas fa-video"></i></span><span class="mtext">Video Conference</span>
                        </a>
                    </li>

                {{-- MENTOR MENU (user_type==3) --}}
                @elseif(Auth::user()->user_type==3)
                    <li>
                        <a href="{{url('mentor/home')}}" class="dropdown-toggle"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
                    </li>
                    <li>
                        <a href="{{url("mentor/profile")}}" class="dropdown-toggle"><i class="fas fa-user-circle"></i>Profile</a>
                    </li>
                    <li>
                        <a href="{{url('admin/Video-Con/list')}}" class="dropdown-toggle"><i class="fas fa-video"></i>Video Conference</a>
                    </li>
                    <li>
                        <a href="{{url('mentor/post')}}" class="dropdown-toggle"><i class="fas fa-users"></i>Mentor List</a>
                    </li>

                {{-- STUDENT MENU (user_type==4) --}}
                @elseif(Auth::user()->user_type==4)
                    <li>
                        <a href="{{url('student/home')}}" class="nav-link"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
                    </li>
                    <li>
                        <a href="{{url('student/mentors')}}" class="dropdown-toggle"><i class="fas fa-users"></i>Mentors</a>
                    </li>
                    <li>
                        <a href="{{url('admin/Video-Con/list')}}" class="dropdown-toggle"><i class="fas fa-video"></i>Video Conference</a>
                    </li>
                    <li>
                        <a href="{{url('student/question-answers')}}" class="dropdown-toggle"><i class="fas fa-question-circle"></i>Questions & Answer</a>
                    </li>
                    <li style="margin-right:20px;">
                        <a href="{{url("student/profile")}}" class="dropdown-toggle" style="border-radius:4px;color: #00a2cb !important;background: #ffff !important; width: 100px;
                        height: 40px;"><i class="fas fa-user-circle" style="color: #00a2cb !important;"></i>Profile</a>
                    </li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</div>
<div class="mobile-menu-overlay"></div>