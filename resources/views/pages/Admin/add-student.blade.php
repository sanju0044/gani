@extends('layouts.app')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Add Student Information</h4>
            </div>
        </div>
        <form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="" id="first_name" class="form-control" placeholder="First Name" required="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Middle Name</label>
                             <input type="text" name="middle_name" value="" id="middle_name" class="form-control" placeholder="middle Name" required="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Name</label>
                            <input type="text" name="last_name" value="" id="last_name" class="form-control" placeholder="Last Name" required="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>School No</label>
                            <input type="text" name="school_no" value="" id="school_no" class="form-control" placeholder="School No" required="">
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
                        <label>Mobile No</label>
                            <input type="text" name="mobile_no" value="" id="mobile" class="form-control" placeholder="Mobile Number" maxlength="10" onkeypress="return isNumber(event)">
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
                        <label>Standard</label>
                        <select class="form-select form-control" name="standard" id="standard" aria-label="Default select example">
                            @foreach($standards as $standard)
                                <option value="{{$standard->name}}" {{$standard->name == Auth::user()->standard  ? 'selected' : ''}}>{{$standard->name}}</option>
                                @endforeach

                        </select>  
                    </div>
                </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-select form-control" name="reference" id="reference" aria-label="Default select example">
                            <option value="">---- Select Type ----</option>
                            <option value="1" {{ 1 == Auth::user()->reference  ? 'selected' : ''}}>Open</option>
                            <option value="2" {{ 2 == Auth::user()->reference  ? 'selected' : ''}}>Student </option>
                            <option value="3" {{ 3 == Auth::user()->reference  ? 'selected' : ''}}>Teacher</option>
                        </select>
                    </div>
                </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" value="" id="age" class="form-control" placeholder="Age" required="">
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
                        <label>States</label>
                        <select name="state_id" id="state_id" class="form-control">
                            <option value="">States</option>
                            @foreach($states as $state)
                            <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="district-container">
                        <label>District</label>
                        <select name="district_id" id="district_id" class="form-control">
                            <option value="">District</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Taluka</label>
                        <input type="text" name="taluka_name" id="taluka_name" placeholder="Taluka" value="" class="form-control" required="">
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
                        <label>View Status</label>
                        <select required class="form-select form-control" name="view_status" id="view_status" aria-label="Default select example">
                            <option value="">---- Select view Status ----</option>
                            <option value="0" {{ 0 == Auth::user()->view_status ? "selected":""}}>View only </option>
                            <option value="1" {{ 1 == Auth::user()->view_status ? "selected":""}}>Interactive</option>
                        </select>   
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input class="form-control" accept="image/*" name="profile_picture" type="file" onchange="loadFile(event)"/>
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
            alert(url)
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
            "state_id": {
                required: true,
            },
            "district_id": {
                required: true,
            },
            "taluka_name": {
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
            "taluka_name":{
                required: "Please select Taluka name.",
            },
            "state_id":{
                required: "Please select state.",
            },
            "district_id":{
                required: "Please select district.",
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

    $("#state_id").change(function(){
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
@endsection

