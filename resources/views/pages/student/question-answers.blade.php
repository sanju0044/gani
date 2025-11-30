@extends('layouts.app') @section('content')
<style>
    .small-box > .small-box-footer {
        background: none;
        color: black;
        text-decoration: underline;
    }
    .profile-post-image-section.col-md-2 img {
        width: 63% !important;
        height: 100px;
    }
    .col-md-10.comment-text.section h4{
        margin-top: 13px !important;
    }
    .col-md-10.comment-text.section{
        margin-left: -45px;
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
    .question-ans-section{
        padding: 40px !important;
    }
    .col-md-10.comment-text.section h4 {
        margin-top: 43px;
    }
    @media only screen and (min-width: 321px) and (max-width: 767px){
        a.nav-link.login-text{
            margin-left: 39%;
        }
        .mentor-name{
            text-align: center;
        }
    }
</style>
<div class="container">

    <div class="tab-content">


        <div id="menu2" >
            <div class="row d-flex flex-wrap align-items-center gallery-images-wrapper">

                @foreach($data as $question)
                <div class="col-md-12">
                    <div class="profile-content-section feedback-form-wrapper">
                        <div class="question-ans-section">
                            <div class="row">
                                <div class="profile-post-image-section col-md-2">
                                    @if (!isset($question->student->profile_picture) && empty($question->student->profile_picture))
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="80" height="80">
                                    @else
                                    <img src="{{URL::to('/')}}/images/{{ $question->student->profile_picture }}" width="80" height="80">

                                    @endif
                                </div>
                                <div class="col-md-10 comment-text section">
                                    @if (isset($question->student->first_name) && !empty($question->student->first_name))
                                    <h4>{{ucfirst($question->student->first_name)}} {{ucfirst($question->student->last_name)}}</h4>
                                    @else
                                    <strong>No record found</strong>
                                    @endif
                                    <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                        <p>{{ucfirst($question->student->cityModel->city_name??"")}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="post-content-section">
                                    <h5 style="color: #00a2cb;">Questions : <span>{{ $question->question }}</span></h5>
                                    <h6 style="color: #00a2cb;">Answer : <span>{{ $question->answer }}</span></h6>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach


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

        function publishPost(){
            var description = $("#description").val()
            if(description=="")
            {
                alert("Please enter description.")
                return;
            }


            $.ajax({
                url: "{{ url('mentor/publish-post') }}",
                type:'post',
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
