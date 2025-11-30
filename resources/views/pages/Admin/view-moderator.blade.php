@extends('layouts.app')

@section('content')
     <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">View Moderator Information</h4>
            </div>
        </div>
        <form class="form-signin profile-form" id="profile" method="post" enctype="multipart/form-data">
            
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ $data->first_name }}"id="inputPassword" class="form-control" placeholder="First Name"required="" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ $data->last_name }}" id="inputPassword"
                    class="form-control" placeholder="Last Name" required="" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" name="email" value="{{ $data->email }}" id="inputPassword"
                    class="form-control" placeholder="Email ID" required="" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="DOB" id="inputtext" value="{{ $data->DOB }}"
                    class="form-control" required="" readonly>
                    </div>
                </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="{{ $data->city }}" id="inputPassword"
                    class="form-control" placeholder="City" required="" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Pin Code</label>
                    <input type="text" name="pincode" value="{{ $data->pincode }}" id="inputPassword"
                    class="form-control" placeholder="Pin Code" required="" readonly>
                </div>
            </div>  
            <div class="col-md-8">
                <div class="form-group">
                    <label>Address</label>
                     <input type="text" name="address" value="{{ $data->address }}" id="address" class="form-control" placeholder="Address" required="" readonly>
                </div>
            </div> 

        </div>
        <div class="form-group">
            <a href="{{url('admin/moderators')}}" class="btn btn-primary student-profile-submit">Back</a>
        </div>
    </div>
   <br><br><br>
@endsection

@section('js_script')

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
    </script>
@endsection
