<style>
    input#check-change-password {
        height: 20px;
        width: 20px;
    }

    @media only screen and (min-width: 321px) and (max-width: 767px) {
        .student-profile-image-col div img {
            width: 100% !important;
        }
    }
    .content-wrapper{
        height: auto !important;
    }
</style>
@extends('layouts.app')

@section('content')
<form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Edit Profile</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" id="first_name" class="form-control" placeholder="First Name" required="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" id="last_name" class="form-control" placeholder="Last Name" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" id="email" class="form-control" placeholder="Email ID" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="DOB" id="DOB" value="{{ Auth::user()->DOB }}" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Standard</label>
                    <select class="form-select form-control" name="standard" id="standard" aria-label="Default select example">
                        @foreach ($standards as $standard)
                            <option value="{{ $standard->name }}"
                                {{ $standard->name == Auth::user()->standard ? 'selected' : '' }}>
                                {{ $standard->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Reference</label>
                    <select class="form-select form-control" name="reference" id="reference"
                                    aria-label="Default select example">
                        <option value="">---- Select Reference ----</option>
                        <option value="1" {{ 1 == Auth::user()->reference ? 'selected' : '' }}>Open</option>
                        <option value="2" {{ 2 == Auth::user()->reference ? 'selected' : '' }}>Student
                        </option>
                        <option value="3" {{ 3 == Auth::user()->reference ? 'selected' : '' }}>Teacher
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" value="{{ Auth::user()->age }}" id="age" class="form-control" placeholder="Age" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>States</label>
                    <select name="state_id" id="state_id" class="form-control">
                        <option value="">States</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->state_id }}" {{Auth::user()->state==$state->state_id?"selected":""}}>{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>District</label>
                    <select name="district_id" id="district_id" class="form-control">
                        <option value="">District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{Auth::user()->district==$district->id?"selected":""}}>{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>City</label>
                    <select name="city_id" id="city_id" class="form-control">
                        <option value="">City</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}" {{Auth::user()->city==$city->id?"selected":""}}>{{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Pin Code</label>
                    <input type="text" name="pincode" value="{{ Auth::user()->pincode }}" id="pincode" class="form-control" placeholder="Pin Code" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Mobile Number</label>
                        <input type="text" name="mobile_no" value="{{ Auth::user()->mobile_no }}" id="pincode" class="form-control" placeholder="Mobile Number" onkeypress="return isNumber(event)" required="" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Address</label>
                        <input type="text" name="address" value="{{ Auth::user()->address }}" id="address" class="form-control" placeholder="Address" required="">
                </div>
            </div>

        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Set Password</h4>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Change Password</label>
                    <input type="checkbox" value="1" id="check-change-password" onchange="switchPasswordFields(this)">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" disabled id="current_password" name="current_password"class="form-control" placeholder="Current Password">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" disabled name="password" id="password" class="form-control" placeholder="New Password">
                </div>
            </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" disabled name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>
            </div>
        </div>
        <button type="Submit" name="save" class="btn btn-primary student-profile-submit btn-lg" >Save</button>
    </div>
</form>
   <br>
   <br>
   <br>
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
                        required: true,
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
                    "standard": {
                        required: true,
                    },
                    "age": {
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
                    "city_id": {
                        required: "Please select city.",
                    },
                    "pincode": {
                        required: "Please enter pin code.",
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
    <script>
        function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            swal("Please enter only Numbers.");
            return false;
          }
        
          return true;
        }
        </script>
@endpush
