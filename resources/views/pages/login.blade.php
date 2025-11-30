<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="keywords" content="agency, bootstrap 5, premium, marketing, business, digital, rtl, sass/scss/saas" />
<meta name="description" content="HTML5 Template" />
<meta name="author" content="www.themeht.com" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Title -->
<title>Ganitalay</title>

<!-- favicon icon -->
<link rel="shortcut icon" href="home/images/favicon.ico" />

<!-- inject css start -->

<!--== bootstrap -->
<link href="home/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!--== animate -->
<link href="home/css/animate.css" rel="stylesheet" type="text/css" />

<!--== fontawesome -->
<link href="home/css/fontawesome-all.css" rel="stylesheet" type="text/css" />

<!--== themify -->
<link href="home/css/themify-icons.css" rel="stylesheet" type="text/css" />

<!--== magnific-popup -->
<link href="home/css/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

<!--== owl-carousel -->
<link href="home/css/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />

<!--== spacing -->
<link href="home/css/spacing.css" rel="stylesheet" type="text/css" />

<!--== base -->
<link href="home/css/base.css" rel="stylesheet" type="text/css" />

<!--== shortcodes -->
<link href="home/css/shortcodes.css" rel="stylesheet" type="text/css" />

<!--== default-theme -->
<link href="home/css/style.css" rel="stylesheet" type="text/css" />

<!--== responsive -->
<link href="home/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="home/css/theme-color/theme-color-2.css" rel="stylesheet" type="text/css" />
<style>
  .footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    left: 0;
    z-index: 999;
    
}

</style>
<!-- inject css end -->

</head>

<body>

<!-- page wrapper start -->

<div class="page-wrapper">
    <header id="site-header" class="header">
    <div id="header-wrap">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand logo" href="index.html">
                <img id="logo-img" class="img-fluid" src="{{asset('public/images/ganitalay.gif')}}" alt="">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span></span>
                <span></span>
                <span></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto position-relative">
                  <!-- Home -->
                  
                </ul>
              </div>
              <div class="right-nav align-items-center d-flex justify-content-end">
                <a class="btn btn-white btn-sm" href="/login">Login</a>             
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
<section class="mt-5">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6 col-md-10">
        <div class="login-form box-shadow white-bg p-4 p-md-5">
          <h2 class="title mb-5">Enter the House of MATHEMATICS!</h2>
          <form  action="{{url('login')}}" method="post">
            <div class="messages"></div>
            <div class="form-group">
              <input id="form_name" type="text" name="user_name" class="form-control" placeholder="User name" required="required" data-error="Username is required.">
              <div class="help-block with-errors">
                  {{-- <span class="fas fa-user"></span> --}}
              </div>
            </div>
            <div class="form-group">
              <input id="form_password" type="password"name="password" id="confirmPassword" class="form-control" placeholder="Password" required="required" data-error="password is required.">
              <div class="help-block with-errors">
                  {{-- <span class="show-password"><i class="fa fa-eye" aria-hidden="true"></i></span>
                  <span class="hide-password"><i class="fa fa-eye" aria-hidden="true"></i></span> --}}
              </div>
            </div>
            <div class="form-group mt-4 mb-5">
              <div class="remember-checkbox d-sm-flex align-items-center justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                </div> <div class="icheck-primary">
                    <a href="{{url('forgot-password')}}">Forgot Password?</a>
                  </div>
              </div>
            </div> <button type="submit" class="btn btn-theme btn-lg"><span>Sign In</span></button>
          </form>
          <div class="social-icons fullwidth social-colored mt-5 text-center clearfix">
            <button type="button" class="btn btn-info text" data-toggle="modal" data-target="#exampleModalCenter">
                How Can You Become Ganitalay Member?
              </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 {{-- <div class="modal-body">
                  <li style="list-style: none"><a href="https://play.google.com/store/apps/details?id=com.snt.ankanaad" target="_blank">Option 1 – Aanknaad App – link</a></li>
                  <li style="list-style: none">Option 2 – If you are listening Aanknaad Tables in your School – ask your teachers</li>
                  <li style="list-style: none"><a href="https://play.google.com/store/apps/details?id=com.snt.ankanaad" target="_blank">Option 3 – Participate in Aanknaad Competition </a></li>
                  <li style="list-style: none">Option 4 – Contact us – <a href="mailto:info@aanknaad.com">info@aanknaad.com</a></li>
                </div> --}}
  @section("js_script")

  <script>


  @if(Session::has('message'))
    swal("error", "{{Session::get('message')}}", "error");
    @php
      Session::forget('message');
    @endphp
  @endif

  </script>
  @endsection
  <br><br><br><br><br>
<footer class="footer white-bg z-index-1 overflow-hidden bg-contain fixed-footer" style="background: #160f0f6b !important;">
  <div class="round-p-animation"></div>
  <div class="secondary-footer" style="background: rgba(0, 0, 0, 0.35) !important;">
    <div class="container">
      <div class="copyright">
        <div class="row align-items-center">
          <div class="col-md-12 text-center text-white">
            <span>MAAP Epic Communications Pvt.Ltd @20222</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>


<!--footer end-->
</div>

<div class="scroll-top"><a class="smoothscroll" href="#top"><i class="flaticon-upload"></i></a></div>

<!--== theme -->
<script src="home/js/theme.js"></script>

<!--== magnific-popup -->
<script src="home/js/magnific-popup/jquery.magnific-popup.min.js"></script> 

<!--== owl-carousel -->
<script src="home/js/owl-carousel/owl.carousel.min.js"></script> 

<!--== counter -->
<script src="home/js/counter/counter.js"></script> 

<!--== countdown -->
<script src="home/js/countdown/jquery.countdown.min.js"></script> 

<!--== isotope -->
<script src="home/js/isotope/isotope.pkgd.min.js"></script> 

<!--== mouse-parallax -->
<script src="home/js/mouse-parallax/tweenmax.min.js"></script>
<script src="home/js/mouse-parallax/jquery-parallax.js"></script> 

<!--== wow -->
<script src="home/js/wow.min.js"></script>

<!--== theme-script -->
<script src="home/js/theme-script.js"></script>

<!-- inject js end -->

</body>

</html><!-- /.login-logo -->
