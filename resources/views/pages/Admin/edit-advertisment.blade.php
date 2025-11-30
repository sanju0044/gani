@extends('layouts.app')

@section('content')
    <style>

    </style>
    <div class="container">
        
        <form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
        <div class="row studet-profile-wrapper">
            <div class="col-md-12 student-profile text-center">
                <div class="text-left mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">Add Advertisment </h1>
                </div>
                <div class="student-profile-image-col">
                
                    <div class="button-upload-image">
                   
                         <input class="form-control form-control-lg" accept="image/*" name="profile_picture" type="file"
                            onchange="loadFile(event)"/>
                            <br>
                            {{$data->profile_picture}}
                           
                            <!-- <input class="form-control form-control-lg" accept="image/*" name="profile_picture1" type="file"
                            onchange="loadFile(event)" /> -->

                            {{-- <button type="file" class="btn btn-default"><i class="fas fa-upload"></i>Upload Advertisment</button> --}}
                     
                    </div>
                    
                </div>
                
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="standard" class="form-check-label">Status</label>
                    </div>
                    <div class="col-md-9">
                        <select required class="form-select form-control" name="status" id="status" aria-label="Default select example">
                            <option value="">---- Select Status ----</option>
                            <option value="0" {{ $data->status == 0 ? "selected":""}}>Active</option>
                            <option value="1" {{ $data->status == 1 ? "selected":""}}>InActive </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 student-profile"> 
                    <div id="change-password-container" >
                    </div>
                    <div class="form-group">
                        <button type="Submit" name="save" class="btn btn-primary student-profile-submit">Save</button>
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
