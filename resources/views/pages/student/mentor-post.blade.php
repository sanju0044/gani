@extends('layouts.app') @section('content')
    <style>
        .small-box>.small-box-footer {
            background: none;
            color: black;
            text-decoration: underline;
        }
        .profile-name-section-1{
            padding-top: 14px;

        }
        .profile-name-section-1 h3 {
            color: #000;
        }

        .profile-name-section-1 p {
            color: #00000085;
            margin-top: -9px;
        }

        .show-profile-wrapper {
            background: #00a2cb;
            color: #ffff;
            padding: 13px;
            margin-bottom: 25px;
        }
        .post-profile-wrapper{
            margin-bottom: 0px !important;
        }
        @media only screen and (min-width: 321px) and (max-width: 767px){
            .student-profile-image-col div img{
                width: 100% !important;
            }
            .profile-wrapper
            {
                padding: 13px 8px;
                margin-top: 20px;
            }
            .profile-button-wrapper
            {
                padding-top: 0px;
            }
        }
    </style>


    <div class="container" style="padding-top: 25px;">
        <div class="row post-profile-wrapper">
            <div class="col-md-10 col-12">
                <div class="profile-image-section">
                    <div>
                        @if ($user->profile_picture == null)
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                width="80" height="80" />
                        @else
                            <img src="{{URL::to('/')}}/images/{{ $user->profile_picture }}" width="80" height="80" />
                        @endif
                    </div>
                    <div class="profile-name-section-1">
                        <h3> {{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</h3>
                        <p>{{ ucfirst($user->short_bio) }}, {{ isset($user->cityModel)?ucfirst($user->cityModel->city_name):"" }}.</p>
                    </div>
                </div>
            </div>
           
                <div class="col-md-2 col-12  profile-button-wrapper" style="text-align:center">
                  {{--  @if(Auth::user()->paid_user==1)--}}
                        @if (isFollowing($user->id, Auth::user()->id))
                            <a onclick="return confirm('are you sure to unfollow?')"
                                href="{{ url('student/mentor/unfollow/' . base64_encode($user->id)) }}"
                                class="nav-link login-text">Unfollow</a>
                        @else
                            <a href="{{ url('student/mentor/follow/' . base64_encode($user->id)) }}"
                                class="nav-link login-text">Follow</a>
                        @endif
                   {{-- @endif--}}
                    <span style="margin: 5px; display:block">{{ getFollowersCount($user->id) }} people following</span>
                </div>


            <div class="col-md-12 tabs-wrapper">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home" onclick="$('#post-container').show()">Home</a></li>
                    <li><a data-toggle="tab" href="#menu4" onclick="$('#post-container').hide()">About</a></li>
                    <li><a data-toggle="tab" href="#menu1" onclick="$('#post-container').hide()">Photos</a></li>
                    <li><a data-toggle="tab" href="#menu2" onclick="$('#post-container').hide()">Followers</a></li>
                    {{-- <li><a data-toggle="tab" href="#menu3">Q&A</a></li> --}}
                </ul>
            </div>
        </div>


        <div class="tab-content">
            <div id="home" class="tab-pane fade show active">



            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="row d-flex flex-wrap align-items-center gallery-images-wrapper" data-toggle="modal"
                                data-target="#lightbox1">
                                @if(count($photos) == 0)
                                <h3>No Photo Found.</h3>
                            @endif
                                @foreach($photos as $photo)
                                <div class="col-12 col-md-6 col-lg-3 mentorpic gallery-image-second-wrapper">
                                    <a href="{{URL::to('/')}}/images/{{$photo->photo}}" target="_blank" >
                                    <img src="{{URL::to('/')}}/images/{{$photo->photo}}"  alt="" />
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="lightbox" role="dialog" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <button type="button" class="close text-right p-2" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div id="indicators" class="carousel slide" data-interval="false">
                                    <ol class="carousel-indicators">
                                        <li data-target="#indicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#indicators" data-slide-to="1"></li>
                                        <li data-target="#indicators" data-slide-to="2"></li>
                                        <li data-target="#indicators" data-slide-to="3"></li>
                                        <li data-target="#indicators" data-slide-to="4"></li>
                                        <li data-target="#indicators" data-slide-to="5"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100"
                                                src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" alt="First slide" />
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" alt="Second slide" />
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" alt="Third slide" />
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" alt="Fourth slide" />
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" alt="Fifth slide" />
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" alt="Sixth slide" />
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#indicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#indicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="row d-flex flex-wrap align-items-center gallery-images-wrapper">

                    @if(count($followers) == 0)
                                <h3>No Follower Found.</h3>
                    @endif
                    @foreach($followers as $follower)
                    <div class="col-md-4 col-6">
                        <div class="row">
                            <div class="col-md-6 mentorpic">
                               @if (!isset($follower->student->profile_picture) && empty($follower->student->profile_picture))
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="160" height="150" style="border: 1px solid #00000038;" />
                                @else
                                <img src="{{URL::to('/')}}/images/{{ $follower->student->profile_picture }}" width="160" height="150" style="border: 1px solid #00000038;" />

                                @endif
                            </div>
                            <div class="col-md-6">
                                @if (isset($follower->student->first_name) && !empty($follower->student->first_name))
                                <strong>{{ucwords($follower->student->first_name)}} {{ucwords($follower->student->last_name)}}</strong>
                                @else
                                <strong>No record found</strong>
                                @endif
                                <p> {{ isset($follower->cityModel)?ucfirst($follower->cityModel->city_name):"" }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div id="menu3" class="tab-pane fade">

                <div class="row feedback-wrapper">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu5">Pending</a></li>
                            <li><a data-toggle="tab" href="#menu6">Answered</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-content-section feedback-form-wrapper">
                            <div class="question-ans-section">
                                <div class="row">
                                    <div class="profile-post-image-section col-md-2 col-3">
                                        <img src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" width="80" height="80">
                                    </div>
                                    <div class="col-md-10 col-9 comment-text section">
                                        <h4>Dr. Raghunath Mashelkar</h4>
                                        <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                            <p>3000 Followers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="post-content-section">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus
                                            dictum rutrum in eget nisl.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                                <div class="col-md-12 text-right" style="margin-top:20px;">
                                    <button type="" class="btn btn-primary">Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-content-section feedback-form-wrapper">
                            <div class="question-ans-section">
                                <div class="row">
                                    <div class="profile-post-image-section col-md-2 col-3">
                                        <img src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" width="80" height="80">
                                    </div>
                                    <div class="col-md-10 col-9 comment-text section">
                                        <h4>Dr. Raghunath Mashelkar</h4>
                                        <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                            <p>3000 Followers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="post-content-section">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus
                                            dictum rutrum in eget nisl.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                                <div class="col-md-12 text-right" style="margin-top:20px;">
                                    <button type="" class="btn btn-primary">Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu4" class="tab-pane fade">
                <div class="row approved-status-wrapper col-12">
                    <div class="container">
                        <form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
                        <div class="row studet-profile-wrapper">
                            <div class="col-md-6 student-profile text-center">
                                <div class="student-profile-image-col">
                                    <div>
                                        @if ($user->profile_picture == null)
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                                style="width:50%" height="251px" id="profile-image-preview" alt="profile-image" />
                                        @else

                                            <img src="{{URL::to('/')}}/images/{{ $user->profile_picture }}" style="width:50%"
                                                height="251px" id="profile-image-preview" alt="profile-image" />
                                        @endif
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 student-profile">

                                    <div class="text-left mb-4">
                                        <h1 class="h3 mb-3 font-weight-normal">Contact Information</h1>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="first_name" class="form-check-label">First Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" disabled name="first_name" value="{{ $user->first_name }}"
                                                    id="first_name" class="form-control" placeholder="First Name" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="last_name" class="form-check-label">Last Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" disabled name="last_name" value="{{ $user->last_name }}" id="last_name"
                                                    class="form-control" placeholder="Last Name" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="email" class="form-check-label">Email ID</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" disabled name="email" value="{{ $user->email }}" id="email"
                                                    class="form-control" placeholder="Email ID" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="DOB"  class="form-check-label">Date of Birth</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="date" disabled name="DOB" id="DOB" value="{{ $user->DOB }}"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="address" class="form-check-label">Address</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" disabled name="address" value="{{ $user->address }}" id="address"
                                                    class="form-control" placeholder="Address" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="city" class="form-check-label">City</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" disabled name="city" value="{{ $user->city }}" id="city"
                                                    class="form-control" placeholder="City" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="pincode" class="form-check-label">Pin Code</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" disabled name="pincode" value="{{ $user->pincode }}" id="pincode"
                                                    class="form-control" placeholder="Pin Code" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="pincode" class="form-check-label">Mobile Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="mobile_no" value="{{ $user->mobile_no }}" id="pincode"
                                                    class="form-control" placeholder="Mobile Number" required="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-left mb-4">
                                        <h1 class="h3 mb-3 font-weight-normal"
                                            style="border-bottom: 1px solid #dfdcdc;padding-bottom:36px;">About </h1>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="short_bio" class="form-check-label">Short Bio </label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" disabled name="short_bio" value="{{ $user->short_bio }}" id="short_bio"
                                                    class="form-control" placeholder="Short Bio" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="current_work_profile" class="form-check-label">Current Work Profile </label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" disabled name="current_work_profile" value="{{ $user->current_work_profile }}" id="current_work_profile"
                                                    class="form-control" placeholder="Describe your current work profile & detail" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="other_details" class="form-check-label">Other Details </label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea type="text" disabled name="other_details"
                                                    class="form-control" id="other_details"
                                                    placeholder="Other Detail" required="">{{ $user->other_details }}</textarea>

                                            </div>
                                        </div>
                                    </div><hr>
                                   

                                    {{-- code  --}}
                            </div>
                        </div>
                    </form>
                    <br>
                    @if(Auth::user()->view_status==1)
                    <div>
                        <span class="btn button-third"
                            style="background: #00a2cb; color:white !important; width:100%">Ask the Experts</span>
                    </div>
                    <br>
                  
                    <form name="ask_expert" id="ask_expert" method="post" action="{{url('student/submit-question')}}">
                        <div class="form-group">
                            {{-- <a type="button" class="btn button-first">Interest 1</a> --}}

                            <input   type="hidden"  name="mentor_id" value="{{$user->id}}"  />
                            <input required class="form-control" type="text" id="name" name="name" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <input required class="form-control" type="text" name="phone" id="phone"
                                placeholder="Phone" />
                        </div>
                        <div class="form-group">
                            <input required class="form-control" type="email" name="email" id="email"
                                placeholder="Email" />
                        </div>
                        <div class="form-group">

                            <textarea required class="form-control" name="question" id="question"
                                placeholder="Message"></textarea>
                        </div>
                        <div>
                            @if(Auth::user()->paid_user==1 || Auth::user()->status==1)
                            <button type="submit" class="btn button-third"
                                style="background: #00a2cb; color:white">Submit</button>
                            @endif

                            {{-- <a href="javascript:void(0)" onclick="submitAskExpertForm()"  class="btn button-third" style="background: #00a2cb; color:white">Submit</a> --}}
                        </div>
                    </form>
                    @endif
                    </div>
                </div>
            </div>
            
            <div id="menu6" class="tab-pane fade">
                <div class="row feedback-wrapper">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu5">Pending</a></li>
                            <li><a data-toggle="tab" href="#menu6">Answered</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-content-section feedback-form-wrapper">
                            <div class="question-ans-section">
                                <div class="row">
                                    <div class="profile-post-image-section col-md-2 col-3">
                                        <img src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" width="80" height="80">
                                    </div>
                                    <div class="col-md-10 col-9 comment-text section">
                                        <h4>Dr. Raghunath Mashelkar</h4>
                                        <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                            <p>3000 Followers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="post-content-section">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus
                                            dictum rutrum in eget nisl.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right" style="margin-top:20px;">
                                    <button type="" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-content-section feedback-form-wrapper">
                            <div class="question-ans-section">
                                <div class="row">
                                    <div class="profile-post-image-section col-md-2 col-3">
                                        <img src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" width="80" height="80">
                                    </div>
                                    <div class="col-md-10 col-9 comment-text section">
                                        <h4>Dr. Raghunath Mashelkar</h4>
                                        <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                            <p>3000 Followers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="post-content-section">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus
                                            dictum rutrum in eget nisl.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right" style="margin-top:20px;">
                                    <button type="" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="post-container">
        <div class="row">

            <div id="div-to-update" class="col-md-9 col-xs-9 col-sm-9 col-lg-9" style="margin-top:27px;">

                @if(count($posts)== 0)
                    <div class="profile-content-section 1">
                        <div class="row">
                            <div class="profile-post-image-section col-md-12">
                                <h3>No Post Found.</h3>
                            </div>
                         </div>
                    </div>
                @endif
                @foreach ($posts as $data )
                    <div class="profile-content-section 2" id="{{ $data->id }}">
                        <div class="row">
                            <div class="profile-post-image-section col-md-2 col-3">
                                @if ($data->mentor->profile_picture == null)
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                        width="80" height="80" />
                                @else
                                    <img src="{{URL::to('/')}}/images/{{ $data->mentor->profile_picture }}" width="80"
                                        height="80" />
                                @endif
                            </div>
                            <div class="col-md-10 col-9 comment-text section">
                                <a href="{{url('student/mentor/post/'.base64_encode($data->mentor->id))}}"> <h4>{{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}</h4></a>
                                <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                    <p>{{ getFollowersCount($data->mentor->id) }} Followers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="post-content-section">
                                <p>
                                    {!! $data->description !!}
                                </p>
                            </div>
                        </div>
                        @if($data->photo)
                            <div class="row">
                                <img src="{{URL::to('/')}}/images/{{$data->photo}}"
                                style="width:100%" alt="post-image-preview" />
                            </div>
                        @elseif($data->video!='?rel=0' || $data->video!='?rel=0?rel=0')
                            <div class="row col-12">
                                <iframe src="{{$data->video}}" height="400" width="100%" id="iframe_id" ></iframe>
                            </div>
                        @else($data->video=='' ?? $data->photo=='')
                            <div></div>
                        @endif
                        <div class="row like-comment-section">
                            <div class="col-md-6 col-6">
                                <a href="javascript:void(0)"><i class="fas fa-thumbs-up"></i><span id="like-counter-{{$data->id}}">{{getTotalPostLikes($data->id)}} {{getTotalPostLikes($data->id)>1?"Likes":"Like"}}</span></a>
                            </div>
                            @if(Auth::user()->view_status==1)
                            <div class="col-md-6 col-6 text-right">
                                <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{$data->id}})"><i class="fas fa-comment"></i><span id="comment-counter-{{$data->id}}">{{getTotalPostComments($data->id)}} Comments</span></a>
                            </div>
                          @endif
                        </div>
                        
                            <div class="row commnents-writing-section">
                                <div class="col-md-2 col-3">
                                    @if(isLiked($data->id, Auth::user()->id))
                                    <a href="javascript:void(0)" class="unlike" data-post-id="{{$data->id}}" onclick="likePost(this, {{$data->id}})"><i class="fas fa-thumbs-up"></i><span>Liked</span></a>
                                    @else
                                    <a href="javascript:void(0)" class="like" data-post-id="{{$data->id}}" onclick="likePost(this, {{$data->id}})"><i class="far fa-thumbs-up"></i><span>Like</span></a>
                                    @endif
                                </div>
                                @if(Auth::user()->view_status==1)
                                    <div class="col-md-6 text-left col-6">
                                        <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{$data->id}})"><i class="fas fa-comments"></i><span>Comments</span></a>
                                    </div>
                                @endif
                            </div>
                      
                        <div id="comment-containers-{{$data->id}}">

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-3 col-xs-4 col-sm-4 col-lg-3 third-section-wrapper">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">


                        
                        {{-- <div class="text-center profile-image-div-third" style="background: white;padding: 0 18px;">
                            <br>
                            <form name="ask_expert" id="ask_expert" method="post" action="{{url('student/submit-question')}}">
                                <div class="form-group"> --}}
                                    {{-- <a type="button" class="btn button-first">Interest 1</a> --}}

                                    {{-- <input   type="hidden"  name="mentor_id" value="{{$user->id}}"  />
                                    <input required class="form-control" type="text" id="name" name="name" placeholder="Name" />
                                </div>
                                <div class="form-group">
                                    <input required class="form-control" type="text" name="phone" id="phone"
                                        placeholder="Phone" />
                                </div>
                                <div class="form-group">
                                    <input required class="form-control" type="email" name="email" id="email"
                                        placeholder="Email" />
                                </div>
                                <div class="form-group">

                                    <textarea required class="form-control" name="question" id="question"
                                        placeholder="Message"></textarea>
                                </div>
                                <div>
                                    @if(Auth::user()->paid_user==1)
                                    <button type="submit" class="btn button-third"
                                        style="background: #00a2cb; color:white">Submit</button>
                                    @endif --}}

                                    {{-- <a href="javascript:void(0)" onclick="submitAskExpertForm()"  class="btn button-third" style="background: #00a2cb; color:white">Submit</a> --}}
                                {{-- </div>
                            </form> --}}
                            <br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

@endsection

@section('js_script')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        @if (Session::has('message'))
            swal("success", "{{ Session::get('message') }}", "success");
            @php
                Session::forget('message');
            @endphp
        @endif

        function setStatus(val) {
            $("#hidden-status").val(val);
            searchMentors();
        }



        function searchMentors() {
            $.ajax({
                url: "{{ url('admin/ajax-student-data') }}",
                data: {
                    name: $("#search_name").val(),
                    email: $("#search_email").val(),
                    status: $("#hidden-status").val(),
                    standard: $("#search_standard").val(),
                    age: $("#search_age").val(),
                },
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        }

        function publishPost() {
            var description = $("#description").val()
            if (description == "") {
                alert("Please enter description.")
                return;
            }


            $.ajax({
                url: "{{ url('mentor/publish-post') }}",
                type: 'post',
                data: {
                    description: description,

                },
                success: function(result) {
                    $("#description").val("");
                    swal("Success", result.message, "success");
                }
            });
        }
    </script>

    <script>
        var loading = true;//to prevent duplicate
    var page = 2;
        @if (Session::has('message'))
            swal("success", "{{ Session::get('message') }}", "success");
            @php
                Session::forget('message');
            @endphp
        @endif


        $('#ask_expert').validate({
            errorClass: 'text-danger',
            ignore: [],
            rules: {
                "name": {
                    required: true,
                },
                "question": {
                    required: true,
                },
                "email": {
                    required: true,
                    email: true,
                },
                "phone": {
                    required: true,
                    number: true,
                },
            },
            messages: {
                "name": {
                    required: "Please enter first name.",
                },
                "question": {
                    required: "Please enter message.",
                },
                "phone": {
                    required: "Please enter phone number.",
                    number: "Please enter valid phone number"
                },
                "email": {
                    required: "Please enter email ID.",
                    email: "Please enter valid Email.",
                },


            }

        });

        function submitAskExpertForm() {

            $.ajax({
                url: "{{ url('admin/ajax-content-data') }}",
                data: {
                    moderator_id: $("#moderator_id").val(),

                },
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        }




function loadNewContent(){
$.ajax({
    type:'POST',
    url: '{{url("student/ajax-load-more-post-mentor")}}',
    data:{ page: page,
    mentor_id: {{$user->id}}
    },
    success:function(data){
        if(data != ""){

            $("#div-to-update").append(data);
            page++
        }else{
            loading = false;
        }
    }
});
}

//scroll DIV's Bottom
$(window).scroll(function() {

if($(window).scrollTop() == $(document).height() - $(window).height()) {

    if(loading)
    {

        loadNewContent()
    }
}
});

function likePost(ele, post_id)
{
    if($(ele).hasClass('like'))
    {
    var str = '<i class="fas fa-thumbs-up"></i><span>Liked</span>';
    $(ele).html(str)
    $(ele).removeClass("like")
    $(ele).addClass("unlike")
    var count = parseInt($("#like-counter-"+post_id).text());
    count++;
    var like_string = " Like";
    if(count>1)
    {
        like_string = " Likes";
    }
    $("#like-counter-"+post_id).text(count+like_string);
    ajaxLikePost(post_id, "like");
    }else{
    var str = '<i class="far fa-thumbs-up"></i><span>Like</span>';
    $(ele).html(str)
    $(ele).removeClass("unlike")
    $(ele).addClass("like")
    var count = parseInt($("#like-counter-"+post_id).text());
    count--;

    var like_string = " Like";
    if(count>1)
    {
        like_string = " Likes";
    }
    $("#like-counter-"+post_id).text(count+like_string);
    ajaxLikePost(post_id, "unlike");
    }
}

function ajaxLikePost(post_id, type)
{
$.ajax({
    type:'POST',
    url: '{{url("student/ajax-like-post")}}',
    data:{ post_id: post_id,
    type:type
    },
    success:function(data){

    }
});
}

function ajaxLoadComment(ele, post_id)
{
$.ajax({
    type:'POST',
    url: '{{url("student/ajax-load-post-comments")}}',
    data:{ post_id: post_id},
    success:function(html){
        $("#comment-containers-"+post_id).html(html);
    }
});
}

function submitComment( post_id)
{
if($.trim($("#input-comment-"+post_id).val()) =="")
{
    alert("Please write comment.");
    return;
}
$.ajax({
    type:'POST',
    url: '{{url("student/ajax-submit-comment")}}',
    data:{
        post_id: post_id,
        comment: $.trim($("#input-comment-"+post_id).val()),

    },
    success:function(html){
        $("#input-comment-"+post_id).val("");
        swal("Success", "Comment submitted successfully! Comment is under approval.", "success");

    }
});
}

</script>

@endsection
