@extends('layouts.app')

@section('content')
    <style>
input[type=checkbox], input[type=radio] {
    width: 40px;
    height: 20px;
   
}
    </style>
    <div class="container">
        <form class="form-signin profile-form" method="post" enctype="multipart/form-data" id="profile">
        <div class="row studet-profile-wrapper">
            <div class="col-md-6 student-profile text-center">
                <div class="student-profile-image-col">
                    <div>
                        @if (Auth::user()->profile_picture == null)
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                style="width:50%" height="251px" id="profile-image-preview" alt="profile-image" />
                        @else

                            <img src="{{URL::to('/')}}/images/{{ Auth::user()->profile_picture }}" style="width:50%"
                                height="251px" id="profile-image-preview" alt="profile-image" />
                        @endif
                    </div>
                    <div class="button-upload-image">
                        <input class="form-control" accept="image/*" name="profile_picture" type="file"
                            onchange="loadFile(event)" style="margin-top:20px;"/>
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
                                <input type="text" name="first_name" value="{{ Auth::user()->first_name }}"
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
                                <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" id="last_name"
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
                                <input type="email" name="email" value="{{ Auth::user()->email }}" id="email"
                                    class="form-control" placeholder="Email ID" required="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="DOB" class="form-check-label">Date of Birth</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="DOB" id="DOB" value="{{ Auth::user()->DOB }}"
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
                                <input type="text" name="address" value="{{ Auth::user()->address }}" id="address"
                                    class="form-control" placeholder="Address" required="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="state_id" class="form-check-label">States</label>
                            </div>
                            <div class="col-md-9">
                                <select name="state_id" id="state_id" class="form-control">
                                    <option vlaue="">State</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->state_id}}" {{$state->id == Auth::user()->sate_id  ? 'selected' : ''}}>{{$state->name}}</option>
                                    <!-- <option value="{{$state->state_id}}">{{$state->state_name}}</option> -->
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="city_id" class="form-check-label">City</label>
                            </div>
                            <div class="col-md-9" id="city-container">
                            <select name="city_id" id="city_id" class="form-control">
                                @foreach($cities as $city)
                                    <option value="{{$city->city_id}}" {{$city->city_id == Auth::user()->city_id  ? 'selected' : ''}}>{{$state->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="pincode" class="form-check-label">Pin Code</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="pincode" value="{{ Auth::user()->pincode }}" id="pincode"
                                    class="form-control" placeholder="Pin Code" required="">
                            </div>
                        </div>
                    </div>


                    <div class="text-left mb-4">
                        <h1 class="h3 mb-3 font-weight-normal"
                            style="border-bottom: 1px solid #dfdcdc;padding-bottom:36px;">Change Password
                            <input type="checkbox"  value="1" id="check-change-password" onchange="switchPasswordFields(this)"></h1>
                    </div>
                    <div id="change-password-container">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="current_password" class="form-check-label">Current Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" disabled id="current_password"  name="current_password" class="form-control"
                                        placeholder="Current Password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="password"  class="form-check-label">New Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" disabled name="password" id="password" class="form-control"
                                        placeholder="New Password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="confirm_password" class="form-check-label">Confirm Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" disabled name="confirm_password" id="confirm_password" class="form-control"
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="Submit" class="btn btn-primary student-profile-submit">Save</button>
                    </div>


            </div>
        </div>
        </form>
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


        var loadFile = function(event) {
            var output = document.getElementById('profile-image-preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

function switchPasswordFields(ele){
    if($(ele).is(":checked"))
    {
        $("#current_password").prop("disabled", false);
        $("#password").prop("disabled", false);
        $("#confirm_password").prop("disabled", false);
    }else{
        $("#current_password").prop("disabled", true);
        $("#password").prop("disabled", true);
        $("#confirm_password").prop("disabled", true);
    }
}

        $(function(){
    $('#profile').validate({
        errorClass: 'text-danger',
        ignore: [],
        rules:{
            "first_name": {
                required: true,
            },
            "last_name": {
                required: true,
            },
            "email": {
                required: true,
                email: true,
                remote: "{{url('check-duplicate-email')}}"
            },
            "DOB": {
                required: true,
            },
            "address": {
                required: true,
            },
            "city": {
                required: true,
            },
            "pincode": {
                required: true,
            },

            "current_password": {
                required:true,
                remote: "{{url('check-current-password')}}"
            },

            "password": {
                required: true,
            },
            "confirm_password": {
                required: true,
                equalTo: "#password",
            },

        },
        messages: {
            "first_name":{
                required: "Please enter first name.",
            },
            "last_name":{
                required: "Please enter last name.",
            },
            "email":{
                required: "Please enter email ID.",
                email: "Please enter valid Email.",
                remote: "Entered email already exist."
            },
            "DOB":{
                required: "Please enter DOB.",
            },
            "address":{
                required: "Please enter address.",
            },
            "city":{
                required: "Please enter city.",
            },
            "pincode":{
                required: "Please enter pin code.",
            },
            "current_password":{
                required: "Please enter current password.",
                remote: "Current password do not match..",
            },
            "password":{
                required: "Please enter new password.",
            },
            "confirm_password":{
                required: "Please enter confirm password.",
                equalTo: "Confirm password do not match with the new password field.",
            },

        }

    });

    // state and city filter
    $("#state_id").change(function(){
        $.ajax({
            url: "{{ url('admin/ajax-add-student-get-city-data') }}",
            data: {
                state_id: $("#state_id").val(),
            },
            success: function(result) {
                $("#city-container").html(result);
            }
        });
    });
})
    </script>
@endsection
