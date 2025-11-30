@extends('layouts.app')

@section('content')
    <style>
        .button-upload-image{
            margin-top: 15px;
        }
    </style>
<form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
    <div class="container card-box mb-30 p-5">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Edit Student</h4>
            </div>
        </div> 
        <div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ $data->first_name }}" id="first_name" class="form-control" placeholder="First Name" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>middle Name</label>
                        <input type="text" name="middle_name" value="{{ $data->middle_name }}" id="first_name" class="form-control" placeholder="middle Name" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $data->last_name }}" id="last_name" class="form-control" placeholder="Last Name" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>School No</label>
                        <input type="text" name="school_no" value="{{ $data->school_no }}" id="last_name" class="form-control" placeholder="School No" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="email" name="email" value="{{ $data->email }}" id="email" class="form-control" placeholder="Email ID" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="number" name="mobile_no" value="{{ $data->mobile_no }}" id="mobile" class="form-control" placeholder="Mobile Number">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="DOB" id="DOB" value="{{ $data->DOB }}"class="form-control" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Standard</label>
                        <select class="form-select form-control" name="standard" id="standard"
                        aria-label="Default select example">
                            @foreach ($standards as $standard)
                                <option value="{{ $standard->name }}"
                                    {{ $standard->name == $data->standard ? 'selected' : '' }}>
                                    {{ $standard->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-select form-control" name="reference" id="reference"
                                aria-label="Default select example">
                                <option value="">---- Select Type ----</option>
                                <option value="1" {{ 1 == $data->reference ? 'selected' : '' }}>Open</option>
                                <option value="2" {{ 2 == $data->reference ? 'selected' : '' }}>Student
                                </option>
                                <option value="3" {{ 3 == $data->reference ? 'selected' : '' }}>Teacher
                                </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" value="{{ $data->age }}" id="age" class="form-control" placeholder="Age" required="">  
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ $data->address }}" id="address"  class="form-control" placeholder="Address" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>States</label>
                        <select name="state_id" id="state_id" class="form-control">
                            <option value="">States</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state_id }}" {{$data->state==$state->state_id?"selected":""}}>{{ $state->state_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" id="district-container">
                        <label>District</label>
                        <select name="district_id" id="district_id" class="form-control">
                            <option value="">District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{$data->district==$district->id?"selected":""}}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group" id="city-container">
                        <label>Taluka</label>
                        <input type="text" name="taluka_name" id="taluka_name" value="{{ $data->city }}" class="form-control" required="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pin Code</label>
                        <input type="text" name="pincode" value="{{ $data->pincode }}" id="pincode"  class="form-control" placeholder="Pin Code" required="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="city-container">
                        <label>Status</label>
                        <select required class="form-select form-control" name="view_status" id="view_status" aria-label="Default select example">
                            <option value="">---- Select view Status ----</option>
                            <option value="0" {{ $data1->view_status == 0 ? "selected":""}}>View only </option>
                            <option value="1" {{ $data1->view_status == 1 ? "selected":""}}>Interactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                         <label>Profile Picture</label>
                            <input class="form-control" accept="image/*" name="profile_picture" type="file" onchange="loadFile(event)" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @if ($data->profile_picture == null)
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                style="width:50%" height="251px" id="profile-image-preview" alt="profile-image" />
                        @else

                            <img src="{{URL::to('/')}}/images/{{ $data->profile_picture }}" style="width:50%" height="251px"
                                id="profile-image-preview" alt="profile-image" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Password</h4>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="form-group">
                <div class="text-left mb-4">
                    <h1 class="h3 mb-3 font-weight-normal"
                        style="border-bottom: 1px solid #dfdcdc;padding-bottom:36px;">Change Password
                        <input type="checkbox" value="1" id="check-change-password"
                            onchange="switchPasswordFields(this)">
                    </h1>
                </div>
            </div>
        </div>
        <div class="row" id="change-password-container">
            <div class="col-md-6">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" disabled name="password" id="password" class="form-control" placeholder="New Password">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" disabled name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="Submit" class="btn btn-primary student-profile-submit">Save</button>
        </div>
        </div>
    </div>
</form>
<br><br><br>
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
                        remote: {
                            url: "{{ url('admin-edit-check-duplicate-email') }}",
                            data: {
                                user_id: '{{ $data->id }}'
                            }
                        }
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
