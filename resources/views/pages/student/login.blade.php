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
  @media only screen and (min-width: 321px) and (max-width: 767px){
    nav.main-header.navbar.navbar-expand.navbar-white.navbar-light.display-desktop{
      display: block !important;
    }
  }
</style>
<!-- /.login-logo -->
<div class="card login-card-wrapper">
    <div class="card-body login-card-body">
      
      <div class="row">
        <div class="col-md-6 login-form-wrapper">
          <h2 class="header-text">Sign in</h2>
        <p class="login-box-msg text-left">Enter the House of MATHEMATICS!  </p>
      
            <form action="../../index3.html" method="post">
              <div class="input-group mb-3">
                
                <input type="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <a href="">Forgot Password?</a>
                  </div>
                </div>
              </div>
              <div clas="row">
                <!-- /.col -->
                <div>
                  <button type="submit" class="btn btn-primary btn-block btn-signin">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
              
              <div class="col-md-12 text-center join-now-text">
                  New on IBIT?<a href="">Join Now</a>
              </div>
            </form>
          </div>
          <div class="col-md-6 wrap d-md-flex">
            <img src="{{asset('public/images/25boss4r210_fjpalm_1.png')}}" style="width:100%" alt="images"/>
          </div>
      </div>  
      
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
