@extends('layouts.app')

@section('content')
<style>
  .wrapper .content-wrapper{
    margin-left:0px !important;
  }
  nav.main-header.navbar.navbar-expand.navbar-white.navbar-light{
    margin-left: 0px !important;
  }
  footer.main-footer{
    margin-left: 0px !important;
  }
  .card{
    box-shadow:none;
  }
  h2.header-text {
      color: #1cacd1;
  }
</style>
<!-- /.login-logo -->
<div class="card login-card-wrapper">
    <div class="card-body login-card-body">

      <div class="row">
        <div class="col-md-6 login-form-wrapper">
          <h2 class="header-text">Reset Password</h2>
        <p class="login-box-msg text-left">Enter new password </p>

            <form   method="post">
              <div class="input-group mb-3">

                <input type="password" class="form-control" placeholder="Password" required="required" name="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>

              <div class="input-group mb-3">

                <input type="password" class="form-control" placeholder="Confirm Password" required="required" name="confirm_password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>



              <div clas="row">
                <!-- /.col -->
                <div>
                  <button type="submit" class="btn btn-primary btn-block btn-signin">Reset Password</button>
                </div>
                <!-- /.col -->
              </div>

              <div class="col-md-12 text-center join-now-text">
                  Have an account?<a href="{{url('/')}}"> Sign In</a>
              </div>
            </form>
          </div>
          <div class="col-md-6 wrap d-md-flex">
            <img src="{{asset('public/images/IBIT Logo-16.png')}}" style="width:100%" alt="images"/>
          </div>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
@endsection

@section("js_script")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
@if(Session::has('message'))
swal('{{Session::get('msg_type')}}', "{{Session::get('message')}}", '{{Session::get('msg_type')}}');
@php
Session::forget('msg_type');
Session::forget('message');
@endphp
@endif
</script>
@endsection
