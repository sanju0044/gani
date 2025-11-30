<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AutoDukan</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('/images/favicon.png') }}">
     @include('includes.head')
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper"><!-- wrapper start-->
      <header>
         @include('includes.header')
      </header>
      <div class="content-wrapper">
        @include('includes.super_admin_sidebar')
        @yield('content')
      </div>
      <footer class="main-footer">
        @include('includes.footer')
        @yield('footer')
      </footer>
    </div><!-- wrapper end-->
    @yield('javascripts')
  </body>
</html>