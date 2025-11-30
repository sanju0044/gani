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
          <h2 class="header-text">Forgot Password?</h2>
        <p class="login-box-msg text-left">Enter your registered email address!  </p>

            <form   method="post">
              <div class="input-group mb-3">

                <input type="email" class="form-control" placeholder="Email" required="required" name="email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>


              <div clas="row">
                <!-- /.col -->
                <div>
                  <button type="submit" class="btn btn-primary btn-block btn-signin">Send an Email</button>
                </div>
                <!-- /.col -->
              </div>

              <div class="col-md-12 text-center join-now-text">
                  Have an account?<a href="{{url('/')}}"> Sign In</a>
              </div>
            </form>
          </div>
          <div class="col-md-6 wrap d-md-flex">
            <img src="{{asset('public/images/login.png')}}" style="width:100%" alt="images"/>
          </div>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
@endsection

@section("js_script")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
@if(Session::has('msg_success'))
swal("success", "{{Session::get('msg_success')}}", "success");
@endif

@if(Session::has('msg_error'))
swal("error", "{{Session::get('msg_error')}}", "error");
@endif
</script>
@endsection
