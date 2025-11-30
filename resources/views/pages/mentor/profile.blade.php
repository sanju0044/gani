@extends('layouts.app')

@section('content')

<form method="post" enctype="multipart/form-data" id="profile">

    <div class="container pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Profile</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>First Name</label>
                        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}"
                        id="first_name" class="form-control" placeholder="First Name" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" id="last_name"
                    class="form-control" placeholder="Last Name" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" id="email"
                        class="form-control" placeholder="Email ID" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="DOB" id="DOB" value="{{ Auth::user()->DOB }}"
                                class="form-control" required="">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="{{ Auth::user()->address }}" id="address"
                        class="form-control" placeholder="Address" required="">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>States</label>
                    <select name="state_id" id="state_id" class="form-control">
                        <option vlaue="">State</option>
                        @foreach($states as $state)
                        <option value="{{$state->state_id}}" {{$state->id == Auth::user()->sate_id  ? 'selected' : ''}}>{{$state->name}}</option>
                        <!-- <option value="{{$state->state_id}}">{{$state->state_name}}</option> -->
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>City</label>
                    <select name="city_id" id="city_id" class="form-control">
                        @foreach($cities as $city)
                            <option value="{{$city->city_id}}" {{$city->city_id == Auth::user()->city_id  ? 'selected' : ''}}>{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Pin Code</label>
                    <input type="text" name="pincode" value="{{ Auth::user()->pincode }}" id="pincode"
                        class="form-control" placeholder="Pin Code" required="">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
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
    </div>
    <div class="container pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <div class="col-md-12">
                    <div class="form-group">
                        <h4 class="text-blue h4">Change Password</label>  <input type="checkbox"  value="1" id="check-change-password" onchange="switchPasswordFields(this)"></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" disabled id="current_password"  name="current_password" class="form-control"placeholder="Current Password">
                </div>
            </div>   
            <div class="col-md-4">
                <div class="form-group">
                    <label for="current_password">New Password</label>
                    <input type="password" disabled name="password" id="password" class="form-control"placeholder="New Password">
                </div>
            </div>  
            <div class="col-md-4">
                <div class="form-group">
                    <label for="current_password">Confirm Password</label>
                    <input type="password" disabled name="confirm_password" id="confirm_password" class="form-control"placeholder="Confirm Password">
                </div>
            </div>  
        </div>      
        <div class="form-group">
            <button type="Submit" class="btn btn-primary student-profile-submit">Save</button>
        </div>
    </div> 
</form>
</br></br></br>
@endsection

@push('scripts')
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



        function switchPasswordFields(ele) {
            if ($(ele).is(":checked")) {
                $("#current_password").prop("disabled", false);
                $("#password").prop("disabled", false);
                $("#confirm_password").prop("disabled", false);
            } else {
                $("#current_password").prop("disabled", true);
                $("#password").prop("disabled", true);
                $("#confirm_password").prop("disabled", true);
            }
        }

        $(function() {
            $('#profile').validate({
                errorClass: 'text-danger',
                ignore: [],
                rules: {
                    "first_name": {
                        required: true,
                    },
                    "last_name": {
                        required: true,
                    },
                    "email": {
                        required: true,
                        email: true,
                        remote: "{{ url('check-duplicate-email') }}"
                    },
                    "DOB": {
                        required: true,
                    },
                    "address": {
                        required: true,
                    },
                    "city_id": {
                        required: false,
                    },
                    "state_id": {
                        required: true,
                    },
                    "district_id": {
                        required: true,
                    },
                    "pincode": {
                        required: true,
                    },
                    "other_details": {
                        required: true,
                    },
                    "short_bio": {
                        required: true,
                    },
                    "current_work_profile": {
                        required: true,
                    },

                    "current_password": {
                        required: true,
                        remote: "{{ url('check-current-password') }}"
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
                    "first_name": {
                        required: "Please enter first name.",
                    },
                    "last_name": {
                        required: "Please enter last name.",
                    },
                    "email": {
                        required: "Please enter email ID.",
                        email: "Please enter valid Email.",
                        remote: "Entered email already exist."
                    },
                    "DOB": {
                        required: "Please enter DOB.",
                    },
                    "address": {
                        required: "Please enter address.",
                    },
                    "standard": {
                        required: "Please enter standard.",
                    },
                    "age": {
                        required: "Please enter age.",
                    },
                    "city": {
                        required: "Please enter city.",
                    },
                    "pincode": {
                        required: "Please enter pin code.",
                    },
                    "other_details": {
                        required: "Please enter other details.",
                    },
                    "short_bio": {
                        required: "Please enter short bio.",
                    },
                    "current_work_profile": {
                        required: "Please enter current work profile.",
                    },
                    "current_password": {
                        required: "Please enter current password.",
                        remote: "Current password do not match..",
                    },
                    "password": {
                        required: "Please enter new password.",
                    },
                    "confirm_password": {
                        required: "Please enter confirm password.",
                        equalTo: "Confirm password do not match with the new password field.",
                    },

                }

            });
            $("#state_id").change(function() {
                $.ajax({
                    url: "{{ url('admin/ajax-add-student-get-district-data') }}",
                    data: {
                        state_id: $("#state_id").val(),
                    },
                    success: function(result) {
                        $("#district-container").html(result);
                    }
                });
            });

        })


        function getCity(ele){
            $.ajax({
                url: "{{ url('admin/ajax-add-student-get-city-data') }}",
                data: {
                    district_id: $(ele).val(),
                },
                success: function(result) {
                    // result = JSON.parse(result)
                    // $("#city-container").html(result);
                    var html = "<option value=''>City</option>";
                    $.each(result,function(index, obj){
                        html +="<option value='"+obj.id+"'>"+obj.city_name+"</option>";
                    })

                    $("#city_id").html(html);

                }
            });

    }
    </script>
@endpush
