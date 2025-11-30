@extends('layouts.app')
 
@section('content')
<style>

</style>
<div class="container">
    <div class="row studet-profile-wrapper">
        <div class="col-md-6 student-profile text-center">
            <div class="student-profile-image-col">    
                <div>
                    <img src="{{asset('public/images/25boss4r210_fjpalm_1.png')}}" style="width:50%" alt="images"/>
                </div>
            </div>
        </div>
        <div class="col-md-6 student-profile">
            <form class="form-signin profile-form">
                <div class="text-left mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">Contact Information</h1>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">First Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputPassword" class="form-control" placeholder="First Name" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Last Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputPassword" class="form-control" placeholder="Last Name" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Email ID</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputPassword" class="form-control" placeholder="Email ID" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Date of Birth</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputtext" class="form-control" placeholder="DD-MM-YYYY" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Standard</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputPassword" class="form-control" placeholder="Standard" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Address</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputPassword" class="form-control" placeholder="Address" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">City</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputPassword" class="form-control" placeholder="City" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Pin Code</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="inputPassword" class="form-control" placeholder="Pin Code" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group" style="border-bottom: 1px solid #dfdcdc;padding-bottom:20px;">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">type</label>
                        </div>
                        <div class="col-md-9">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary">Student</button>
                                <button type="button" class="btn btn-default">Customer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-left mb-4">
                    <h1 class="h3 mb-3 font-weight-normal" style="border-bottom: 1px solid #dfdcdc;padding-bottom:36px;">Change Password</h1>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Current Password</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Current Password" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">New Password</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" id="inputPassword" class="form-control" placeholder="New Password" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="checkbox1" class="form-check-label">Confirm Password</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="Submit" class="btn btn-primary student-profile-submit">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection