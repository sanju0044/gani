@extends('layouts.app')

@section('content')
    <style>


    </style>
    <div class="container card-box mb-30 p-5">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">View Student</h4>
            </div>
        </div>  
        <form class="form-signin profile-form" method="post" enctype="multipart/form-data">
        <div class="row studet-profile-wrapper">
            <div class="col-md-12 student-profile text-center">
                <div class="student-profile-image-col">
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
                <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="user_name" value="{{ $data->user_name }}"
                                    id="inputPassword" class="form-control" placeholder="User Name" required="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="{{ $data->first_name }}"
                                    id="inputPassword" class="form-control" placeholder="First Name" required="" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">  
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" value="{{ $data->middle_name }}"
                                    id="inputmiddle" class="form-control" placeholder="Middle Name" required="" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">  
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="{{ $data->last_name }}" id="inputPassword"
                                    class="form-control" placeholder="Last Name" required="" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">  
                                <label>School No</label>
                                <input type="text" name="school_no" value="{{ $data->school_no }}" id="inputSchool"
                                    class="form-control" placeholder="School No" required="" readonly>
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
                                <label>Mobile NO</label>
                                <input type="number" name="mobile_no" value="{{ $data->mobile_no }}" id="inputPassword" class="form-control" placeholder="Mobile No" readonly>
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
                                <label>Standard</label>
                                <input type="text" name="standard" value="{{ $data->standard }}" id="inputPassword"
                                    class="form-control" placeholder="Standard" required="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">  
                                <label>Age</label>
                                <input type="number" name="age" value="{{ $data->age }}"id="inputPassword"
                                    class="form-control" placeholder="Age" required="" readonly>
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
                                <input type="text" name="pincode" value="{{ $data->pincode }}" id="inputPassword" class="form-control" placeholder="Pin Code" required="" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">  
                                <label>Address</label>
                                <input type="text" name="address" value="{{ $data->address }}" id="inputPassword"
                                    class="form-control" placeholder="Address" required="" readonly>
                            </div>
                        </div>
                        <div id="change-password-container" style="display: none">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Current Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" id="inputPassword" class="form-control"
                                            placeholder="Current Password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>New Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" id="inputPassword" class="form-control"
                                            placeholder="New Password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Confirm Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" id="inputPassword" class="form-control"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <a href="{{url('admin/students')}}" class="btn btn-primary student-profile-submit">Back</a>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <br><br><br>
@endsection

@push('scripts')

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
@endpush
