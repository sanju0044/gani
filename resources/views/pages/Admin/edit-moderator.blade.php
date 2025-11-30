@extends('layouts.app')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Edit Moderator Information</h4>
            </div>
        </div>
        <form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
            
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ $data->first_name }}" id="first_name" class="form-control" placeholder="First Name" required=""> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ $data->last_name }}" id="last_name"
                    class="form-control" placeholder="Last Name" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" name="email" value="{{ $data->email }}" id="email"class="form-control" placeholder="Email ID" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="DOB" id="DOB" value="{{ $data->DOB }}" class="form-control" required="">
                    </div>
                </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="{{ $data->address }}" id="address" class="form-control" placeholder="Address" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="{{ $data->city }}" id="city" class="form-control" placeholder="City" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Pin Code</label>
                    <input type="text" name="pincode" value="{{ $data->pincode }}" id="pincode"class="form-control" placeholder="Pin Code" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Approval Type</label>
                    <select required class="form-select form-control" name="moderator_type" id="moderator_type" aria-label="Default select example">
                        <option value="">---- Select Approval Type ----</option>
                        <option value="1" {{ $data->moderator_type == 1 ? "selected":""}}>Post Approval</option>
                        <option value="2" {{ $data->moderator_type == 2 ? "selected":""}}>Q/A Approval</option>
                        <option value="3" {{ $data->moderator_type == 3 ? "selected":""}}>Comments Approval</option>
                    </select>
                </div>
            </div> 
            <div class="col-md-12">
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input class="form-control form-control-lg" accept="image/*"name="profile_picture" type="file"onchange="loadFile(event)" />
                    </div>
            </div>  
            <div class="col-md-12">
                <div class="form-group">
                    <label>Address</label>
                     <input type="text" name="address" value="{{ $data->address }}" id="address" class="form-control" placeholder="Address" required="">
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
        <button type="Submit" name="save" class="btn btn-primary student-profile-submit btn-lg" >Save</button>
    </div>
    </form>   
    <br/>
    <br/>
    <br/>
   
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
                    "city": {
                        required: true,
                    },
                    "pincode": {
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
        })
    </script>
@endpush
