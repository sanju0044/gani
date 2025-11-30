@extends('layouts.app')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Add Moderator Information</h4>
            </div>
        </div>
        <form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
            
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="" id="first_name" class="form-control" placeholder="First Name" required="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="" id="last_name" class="form-control" placeholder="Last Name" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" name="email" value="" id="email" class="form-control" placeholder="Email ID" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="DOB" id="DOB" value="" class="form-control" required="">
                    </div>
                </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="" id="address" class="form-control" placeholder="Address" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="" id="city" class="form-control" placeholder="City" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Pin Code</label>
                    <input type="text" name="pincode" value="" id="pincode" class="form-control" placeholder="Pin Code" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input class="form-control form-control-lg" accept="image/*"name="profile_picture" type="file"onchange="loadFile(event)" />
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password</label>
                     <input type="password"  name="password" id="password" class="form-control" placeholder="Password">
                </div>
            </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm Password</label>
                     <input type="password"  name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
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
                remote: "{{url('admin-check-duplicate-email')}}"
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
            "standard":{
                required: "Please enter standard.",
            },
            "age":{
                required: "Please enter age.",
            },
            "city":{
                required: "Please enter city.",
            },
            "pincode":{
                required: "Please enter pin code.",
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
    
@endsection
