@extends('layouts.app') @section('content')
<style>
    .small-box > .small-box-footer {
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

                @foreach($data as $obj)
                <div class="col-md-12 col-12">
                    <div class="row profile-sub-wrapper">
                        <div class="col-md-2 mentorpic">
                            @if ($obj->profile_picture == null)
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="120" height="120"/>
                            @else
                                <img src="{{asset('/images/')}}/{{ $obj->profile_picture }}" width="120" height="120"/>
                            @endif
                          
                        </div>
                        <div class="col-md-10">
                            <div class="row" style="padding-top:28px;">
                                <div class="col-md-9 mentor-name">
                                    <strong>{{ucwords($obj->first_name)}} {{ucwords($obj->last_name)}}</strong>
                                    <p>{{ isset($obj->cityModel)?ucfirst($obj->cityModel->city_name):"" }}</p>
                                </div>
                                <div class="col-md-3 col-8">
                                        <a href="{{url('student/mentor/post/'.base64_encode($obj->id))}}" class="nav-link login-text text-center" style="width:80%"><i class="fas fa-user-circle profile-icon"></i>View Profile</a>
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
@push('scripts')


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
@endpush
