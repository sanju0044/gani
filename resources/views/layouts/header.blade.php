
<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name">{{Auth::user()->first_name ?? ''}}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="{{url("student/profile")}}"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="{{url('/logout')}}"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

{{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light display-desktop">


    <ul class="navbar-nav float-right">
      <li class="nav-item d-sm-inline-block logo-header-images">
        <a href="{{url('/')}}">
          <img src="{{asset('images/ganitalay.gif')}}" class="ganitalay-logo">
        </a>
      </li>
    </ul>

     <ul class="navbar-nav ml-auto">


      @if(Auth::check())

      <li class="nav-item">
          <a class="nav-link text-white" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search" ></i>
          </a>
          <div class="navbar-search-block" style="display:none;">
            <form class="form-inline" action="{{ url('/search') }}">
              <div class="input-group input-group-sm input-search-wrap-desktop">
                <input class="form-control form-control-navbar" type="search" name="term" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

      @if(Auth::user()->user_type==1 )
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/dashboard')}}" class="nav-link"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/students')}}" class="nav-link "><i class="fas fa-user"></i>Students</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/mentors')}}" class="nav-link "><i class="fas fa-user"></i>Mentors</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/moderators')}}" class="nav-link "><i class="fas fa-user"></i>Moderator</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/Video-Conference/list')}}" class="nav-link "><i class="fas fa-video"></i>Video Conference</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/content-approval')}}" class="nav-link "><i class="fas fa-cube"></i>Content Approval</a>
      </li>

       <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/activity-logs')}}" class="nav-link "><i class="fa fas fa-history" aria-hidden="true"></i>Activity Logs</a>
      </li>

      @elseif(Auth::user()->user_type==2)
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/dashboard')}}" class="nav-link"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/Video-Conference/list')}}" class="nav-link "><i class="fas fa-cube"></i>Video Conference</a>
      </li>

      @elseif(Auth::user()->user_type==3)
      <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('mentor/home')}}" class="nav-link"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url("mentor/profile")}}" class="nav-link "><i class="fas fa-user-tie "></i>Profile</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/Video-Con/list')}}" class="nav-link "><i class="fas fa-cube"></i>Video Conference</a>
      </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('mentor/post')}}" class="nav-link "><i class="fas fa-cube"></i>Mentor List</a>
        </li>
            @elseif(Auth::user()->user_type==4)
            <li class="nav-item d-sm-inline-block">
                <a href="{{url('student/home')}}" class="nav-link"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
              </li>
              <li class="nav-item d-sm-inline-block">
                <a href="{{url('student/mentors')}}" class="nav-link "><i class="fas fa-user"></i>Mentors</a>
              <li class="nav-item d-none d-sm-inline-block">
                 <a href="{{url('admin/Video-Con/list')}}" class="nav-link "><i class="fas fa-cube"></i>Video Conference</a>
               </li>
              <li class="nav-item d-sm-inline-block">
                <a href="{{url('student/question-answers')}}" class="nav-link "><i class="fas fa-comments"></i>Questions & Answer</a>
              </li>
              <li class="nav-item d-sm-inline-block" style="margin-right:20px;">
                <a href="{{url("student/profile")}}" class="nav-link " style="border-radius:4px;color: #00a2cb !important;background: #ffff !important; width: 100px;
                height: 40px;"><i class="fas fa-user-tie" style="color: #00a2cb !important;"></i>Profile</a>
              </li>
            @endif

      <li class="nav-item d-sm-inline-block">
        <a href="{{url('/logout')}}" class="nav-link login-text" style="border-radius:4px;color: #00a2cb !important;background: #ffff !important; width: 100px;
        height: 40px;"><i class="fas fa-sign-in-alt profile-icon" style="color: #00a2cb !important;"></i>Logout</a>
      </li>
      @else
      <li class="nav-item d-sm-inline-block">
        <a href="{{url('/login')}}" class="nav-link login-text" style="border-radius:4px;color: #00a2cb !important;background: #ffff !important;height: 40px;"><i class="fas fa-sign-in-alt profile-icon" style="color: #00a2cb !important;"></i><span style="color:black;">Login</span></a>
      </li>


      @endif
    </ul>
</nav> --}}

<!-- Mobile navbar -->

{{-- @if(Auth::check())
    @if(Auth::user()->user_type==4 )
   <div class="row mobile-menu-wrapper">
        <div class="col-12 parrent-menu-wrapper">
          <div class="parent-menu">
            <div class="navbar-header">
              <div class="col-12 float-left d-flex">
                <div class="logo-header-images">
                    <img src="{{asset('public/images/GanitalayaLogo.svg')}}" class="sl-ganitalay-logo">
                </div>
                <div class="profile-image-wrapper text-center">
                      <a href="{{url("student/profile")}}" >
                      @if (Auth::user()->profile_picture == null)
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="60" height="60">
                      @else
                      <img src="{{URL::to('/')}}/storage/images/{{ Auth::user()->profile_picture }}" class="sl-ganitalay-side-logo">
  
                      @endif
                    </a>
                  </div>
                 
                <div class="logo-header-images1">
                  <a href="{{url('logout')}}" class="nav-link btn-logout" style="color: #00a2cb !important;background: #ffff !important;border-radius:4px;"><i class="fas fa-user btn-logout-fas" style="color: #00a2cb !important;"></i>Logout</a>
                </div>

                <li class="nav-item search-item">
                  <a class="nav-link text-white search-icon" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search" ></i>
                  </a>
                  <div class="navbar-search-block" style="display:none;">
                    <form class="form-inline" action="{{ url('/search') }}">
                      <div class="input-group input-group-sm input-search-wrap">
                        <input class="form-control form-control-navbar" type="search" name="term" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                          <button class="btn btn-navbar search-side-btn" type="submit">
                            <i class="fas fa-search"></i>
                          </button>
                          <button class="btn btn-navbar search-side-btn" type="button" data-widget="navbar-search">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li> 

              </div>
            </div>
          </div>
        </div>
        <div class="col-12 d-flex">
          <div class="logo-header-images sl-images">
            <a href="{{url('student/home')}}" class="nav-link"><i class="fas fa-home sl-icon" aria-hidden="true"></i>Home</a>
          </div>
          <div class="logo-header-images sl-images">
            <a href="{{url('student/mentors')}}" class="nav-link "><i class="fas fa-user sl-icon"></i>Mentors</a>
          </div>
          <div class="logo-header-images sl-images">
            <a href="{{url('admin/Video-Con/list')}}" class="nav-link "><i class="fas fa-cube sl-icon"></i>Video Conference</a>
          </div>
          <div class="logo-header-images sl-images">
            <a href="{{url('student/question-answers')}}" class="nav-link "><i class="fas fa-comments sl-icon"></i>Q&A</a>
          </div>
        </div>
      </div>
    @endif
    @if(Auth::user()->user_type==1 )
    <div class="row mobile-menu-wrapper">
      <div class="col-12 parrent-menu-wrapper">
        <div class="parent-menu">
          <div class="navbar-header">
          </div>
        </div>
      </div>
      
    </div>
    @endif

    @if(Auth::user()->user_type==3 )
    <div class="row mobile-menu-wrapper">
      <div class="col-12 parrent-menu-wrapper">
        <div class="parent-menu">
          <div class="navbar-header">
            <div class="col-12 float-left d-flex">
              <div class="logo-header-images">
                  <img src="{{asset('public/images/Ganitalay-Logo.png')}}" id="img-wrap">
              </div>
              <div class="logo-header-images1">
                <a href="{{url("student/profile")}}" class="nav-link " style="color: #00a2cb !important;background: #ffff !important;"><i class="fas fa-user-tie" style="color: #00a2cb !important;border-radius:4px;"></i>Profile</a>
              </div>
               <div class="logo-header-images1">
                <a href="{{url('logout')}}" class="nav-link " style="color: #00a2cb !important;background: #ffff !important;border-radius:4px;"><i class="fas fa-user" style="color: #00a2cb !important;"></i>Logout</a>
              </div>
              <li class="nav-item search-item">
                  <a class="nav-link text-white search-icon" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search" ></i>
                  </a>
                  <div class="navbar-search-block" style="display:none;">
                    <form class="form-inline" action="{{ url('/search') }}">
                      <div class="input-group input-group-sm input-search-wrap-login">
                        <input class="form-control form-control-navbar" type="search" name="term" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                          <button class="btn btn-navbar search-side-btn" type="submit">
                            <i class="fas fa-search"></i>
                          </button>
                          <button class="btn btn-navbar search-side-btn" type="button" data-widget="navbar-search">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li> 

            </div>
          </div>
        </div>
      </div>
      <div class="col-12 d-flex">
        <div class="logo-header-images">
          <a href="{{url('student/home')}}" class="nav-link"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
        </div>
        <div class="logo-header-images">
            <a href="{{url('admin/Video-Con/list')}}" class="nav-link "><i class="fas fa-cube"></i>Video Conference</a>
          </div>
        <div class="logo-header-images">
          <a href="{{url('student/mentors')}}" class="nav-link "><i class="fas fa-user"></i>Mentors</a>
        </div>
        <div class="logo-header-images float-right">
          <a href="{{url('logout')}}" class="nav-link "><i class="fas fa-user"></i>Logout</a>
        </div>
      </div>
    </div>
    @endif
@endif --}}
