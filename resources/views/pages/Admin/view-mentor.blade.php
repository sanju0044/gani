@extends('layouts.app')

@section('content')
      <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Contact Information</h4>
            </div>
        </div>
        <form class="form-signin profile-form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                       <input type="text" name="first_name" value="{{ $data->first_name }}"id="first_name" class="form-control" placeholder="First Name" readonly >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $data->last_name }}" id="last_name"
                                    class="form-control" placeholder="Last Name" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="email" name="email" value="{{ $data->email }}" id="email"class="form-control" placeholder="Email ID" readonly>
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
                       <input type="date" name="DOB" id="DOB" value="{{ $data->DOB }}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pin Code</label>
                        <input type="text" name="pincode" value="{{ $data->pincode }}" id="pincode" class="form-control" placeholder="Pin Code" readonly>
                    </div>
                </div>
                <div class="col-md-4">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ $data->address }}" id="address" class="form-control" placeholder="Address" readonly>
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
            <div class="col-md-12">
                <div class="form-group">
                    <label>Current Work Profile</label>
                    <input type="text" name="current_work_profile" value="{{ $data->current_work_profile }}" id="current_work_profile" class="form-control" placeholder="Describe your current work profile & detail" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Add Short Bio</label>
                    <textarea type="text" name="short_bio" class="form-control" id="short_bio" placeholder="Short Bio" readonly>{{ $data->short_bio }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Other Details</label>
                    <textarea type="text" name="other_details" class="form-control" id="other_details" placeholder="Other Detail" readonly>{{ $data->other_details }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <a href="{{url('/admin/mentors')}}" class="btn btn-primary student-profile-submit">Back</a>
        </div>
    </div>
    </form>   
    <br/>
    <br/>
    <br/>

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
