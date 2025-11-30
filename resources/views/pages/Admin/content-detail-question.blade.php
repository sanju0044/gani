@extends('layouts.app') @section('content')
    <style>
        .small-box>.small-box-footer {
            background: none;
            color: black;
            text-decoration: underline;
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
        .mentor{
            text-align:center;
        }
        .ment{
            margin-left: 118px;
            /* margin-top: -12px; */
            position: relative;
            top: -33px;
        }
        

    </style>
<div class="container" style="padding-top: 25px;">
        @php 
            $mentor = 0;
            $student = 0;
        @endphp
    @if (isset($data->mentor))
        <div class="row post-profile-wrapper">
            <div class="col-md-10 col-8">
           
                <div class="profile-image-section">
                    <div>
                        @if ($data->mentor->profile_picture == null)
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                width="80" height="80" />
                        @else
                            <img src="{{URL::to('/')}}/images/{{ $data->mentor->profile_picture }}" width="80" height="80" />
                        @endif
                    </div>
                    <div class="profile-name-section-1">
                        <h3> {{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}</h3>
                        <p>{{ $data->mentor->short_bio }}, {{ $data->mentor->city }}.</p>
                    </div>
                </div>
            </div>
           
            <div class="col-md-2 col-4 text-right profile-button-wrapper" style="max-width: 13.666667% !important">

                <a href="{{url('admin/content-approval')}}" class="nav-link login-text"><i
                        class="fas fa-arrow-left profile-icon"></i>Go Back</a>
            </div>

        </div>
       
        <div class="tab-content">
            <div id="home" class="tab-pane fade show active">
                <div class="row section-first-post" >


                    <div class="col-md-8">

                        <div class="profile-content-section">
                            <div class="row">
                                <div class="profile-post-image-section col-md-2">
                                    @if ($data->mentor->profile_picture == null)
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                            width="80" height="80" />
                                    @else
                                        <img src="{{URL::to('/')}}/images/{{ $data->mentor->profile_picture }}" width="80"
                                            height="80" />
                                    @endif
                                </div>
                                <div class="col-md-10 comment-text section">
                                    <h4>{{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}</h4>

                                </div>
                            </div>
    @else
        @php
            $mentor = 1;
        @endphp
    @endif

                            @if(isset($data->student))
                                <div class="col-md-12">
                                    <div class="post-content-section">
                                        <div class="profile-content-section feedback-form-wrapper">
                                            <div class="question-ans-section">
                                                <div class="row">
                                                    <div class="profile-post-image-section col-md-2">
                                                        @if ($data->student->profile_picture == null)
                                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="80" height="80">
                                                        @else
                                                        <img src="{{URL::to('/')}}/images/{{ $data->student->profile_picture }}" width="80" height="80">

                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 comment-text section">
                                                        <h4>{{ucfirst($data->student->first_name)}} {{ucfirst($data->student->last_name)}}</h4>
                                                        <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                                            <p>{{ucfirst($data->student->city)}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="post-content-section">
                                                        <h5>
                                                            {{$data->question}}
                                                        </h5>

                                                        <p>
                                                            {{$data->answer}}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                @if($data->photo)
                                <div class="row">
                                    <iframe width="854" height="480"
                                        src="https://www.youtube.com/watch?list=PLlh37aqSB8iLCDRQzZeHP3DgRtknPLhnT&v=bEhehlktCgI&feature=youtu.be"
                                        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                                @endif
                                <br>

                                <div class="row commnents-writing-section" style="text-align: center">
                                    <h3>Status: {{$data->status=='0'? 'Pending':($data->status=='1'?"Approved":"Disapproved")}}</h3>
                                </div>
                                <div class="row commnents-writing-section" style="text-align: center">

                                    @if($data->status =="0")
                                    <div class="col-md-2 col-3">
                                        <a href="{{url('admin/content-approval1/approve-question/'.$data->id)}}"
                                            class="nav-link login-text">Approve</a>
                                    </div>

                                    <div class="col-md-2 col-3">
                                        <a href="{{url('admin/content-approval1/disapprove-question/'.$data->id)}}"
                                            class="nav-link login-text">Disapprove</a>
                                    </div>
                                    @endif
                                    <div class="col-md-2 col-3">
                                        <a href="{{url('admin/content-approval')}}"
                                            class="nav-link login-text">Back</a>
                                    </div>

                                </div>
                            @else
                                @php
                                    $student = 1;
                                @endphp
                            @endif

                        </div>
                        <br>
        <span class="message">
            @if($mentor== 1 && $student== 1 )
                <h4 class="mentor">Both Mentor and Student not available</h4>
            @elseif($mentor== 1 && $student== 0)
                <h4 class="ment"> Mentor not available</h4>
            @elseif($mentor== 0 && $student== 1)
                <h4> Student not available</h4>
            @endif
        </span>
        </div>
                </div>
            </div>
           
       
</div>
@endsection
@section('js_script')


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
@endsection
