@extends('layouts.app')
@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Contact Information</h4>
            </div>
        </div>
        <form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                       <input type="text" name="first_name" value="{{ $data->first_name }}"id="first_name" class="form-control" placeholder="First Name" required="">
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
                        <label>Mobile No</label>
                         <input type="number" name="mobile_no" value="{{ $data->mobile_no }}" id="mobile" class="form-control" placeholder="Mobile Number">
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
                    <div class="form-group">
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
                    <div class="form-group">
                        <label>Taluka</label>
                        <input type="text" name="taluka_name" id="taluka_name" value="{{ $data->city }}" class="form-control" required="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pin Code</label>
                        <input type="text" name="pincode" value="{{ $data->pincode }}" id="pincode" class="form-control" placeholder="Pin Code" required="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Profile Picture</label>
                         <input class="form-control" accept="image/*" name="profile_picture" type="file"
                            onchange="loadFile(event)" />                
                     </div>
                     <div>
                        @if ($data->profile_picture == null)
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                style="width:50%" height="251px" id="profile-image-preview" alt="profile-image" />
                        @else
                            <img src="{{URL::to('/')}}/images/{{ $data->profile_picture }}" style="width:50%"
                                height="251px" id="profile-image-preview" alt="profile-image" />
                        @endif
                    </div>
                </div>  
            </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">About</h4>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mentor Type</label>
                    <select required class="form-select form-control" name="mentor_type" id="mentor_type" aria-label="Default select example">
                        <option value="">---- Select Mentor Type ----</option>
                        <option value="1" {{ $data->mentor_type == 1 ? "selected":""}}>Local</option>
                        <option value="2" {{ $data->mentor_type == 2 ? "selected":""}}>Academician </option>
                        <option value="3" {{ $data->mentor_type == 3 ? "selected":""}}>National / International</option>
                        <option value="4" {{ $data->mentor_type == 4 ? "selected":""}}>Exclusive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Senior Mentor</label>
                    <select required class="form-select form-control" name="senior_mentor" id="mentor_type" aria-label="Default select example">
                        <option value="">---- Select ----</option>
                        <option value="1" {{ $data->senior_mentor == 1 ? "selected":""}}>Yes</option>
                        <option value="2" {{ $data->senior_mentor == 2 ? "selected":""}}>No </option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Current Work Profile</label>
                    <input type="text" name="current_work_profile" value="{{ $data->current_work_profile }}" id="current_work_profile" class="form-control" placeholder="Describe your current work profile & detail" required="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Add Short Bio</label>
                    <textarea type="text" name="short_bio" class="form-control" id="short_bio" placeholder="Short Bio" required="">{{ $data->short_bio }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Other Details</label>
                    <textarea type="text" name="other_details" class="form-control" id="other_details" placeholder="Other Detail" required="">{{ $data->other_details }}</textarea>
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
            <div class="col-md-6" id="change-password-container">
                <div class="form-group">
                    <label>Password</label>
                     <input type="password" disabled name="password" id="password" class="form-control" placeholder="New Password">
                </div>
            </div>
            <div class="col-md-6" id="change-password-container">
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

        $('#state_id').change(function()
        {
            var state_id = $(this).val();
            var url = '{{ url('/admin/ajax-get-district-data') }}/'+state_id;
            $.ajax({
                type: 'GET',
                url: url,
                data : {state_id:state_id},
                success:function(response){
                    console.log(response)
                    $('#district_id').html(response);
                }
            });
        });
        $('#district_id').change(function()
        {
            var district_id = $(this).val();
            var url = '{{ url('/admin/ajax-add-student-get-city-data') }}/'+district_id;
            $.ajax({
                type: 'GET',
                url: url,
                data : {district_id:district_id},
                success:function(response){
                    console.log(response)
                    $('#city_id').html(response);
                }
            });
        });

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
            "other_details": {
                required: true,
            },
            "short_bio": {
                required: true,
            },
            "current_work_profile": {
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
            "other_details": {
                required: "Please enter other details.",
            },
            "short_bio": {
                required: "Please enter short bio.",
            },
            "current_work_profile": {
                required: "Please enter current work profile.",
            },

            "password":{
                required: "Please enter password.",
            },
            "confirm_password":{
                required: "Please enter confirm password.",
                equalTo: "Confirm password do not match with the new password field.",
            },

        }

    });
})
    </script>
@endpush

