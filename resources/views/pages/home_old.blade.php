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
  .home-wrapper h2 {
    font-size: 42px;
    line-height: 50px;
    color: #00a2cb;
    margin-bottom: 15px;
    text-transform: uppercase;
    font-family: 'poppinsbold';
  }
  .home-wrapper h2 span {
    font-size: 16px;
    line-height: 18px;
    color: #666666 !important;
    display: inline-block;
    text-transform: none;
    font-family: 'poppinsregular';
  }
  .featureLeft {
    margin-top: 55px;
  }
  .featureRight ul {
    list-style: none;
    padding-left: 0px;
  }
  .featureRight ul li {
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 15px;
    font-size: 14px;
  }
  .home-wrapper p {
    font-size: 14px;
  }
  .featureRight ul li:after {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 3px;
    content: "";
    background: #00a2cb;
  }
  .aboutWrap .aboutLeft {
    /*margin-top: 22px;*/
  }
  @media only screen and (min-width: 321px) and (max-width: 767px){
    nav.main-header.navbar.navbar-expand.navbar-white.navbar-light.display-desktop{
      display: flex !important;
    }
    .aboutWrap .aboutLeft {
      margin-top: 0px;
    }
    .mobile-reverse{
      flex-direction: column-reverse;
    }
    .featureLeft {
      margin-top: 0px;
      margin-bottom: 15px;
    }
  }
</style>
<!-- /.login-logo -->
<div class="home-wrapper">
    <!-- <div class="card-body login-card-body"> -->
      <!--start here-->
<div class="container-fluid px-0">
  <div class="row">
    <div class="col-md-12 px-0">
      <!-- <img src="{{asset('public/images/banner1.jpg')}}" class="img-fluid" alt="images"/> -->
      <!--vodeo-->
      <div class="bannerSlider slider">
          <video width="100%" autoplay loop muted>
            <source src="{{asset('public/images/banner.mp4')}}" type="video/mp4">
            <source src="{{asset('public/images/banner.ogg')}}" type="video/ogg">
            Your browser does not support HTML video.
          </video>
         <!--  <img style="width:100%" class="img img-responsive" src="{{asset('public/images/ganitalay-home1.jpg')}}"> -->
      </div>
      <!--vodeo end-->
    </div>
  </div>
</div>

<div class="clear"></div>
<!-- For Component View -->
      <div id="meetingSDKElement">
        <!-- Zoom Meeting SDK Rendered Here -->
      </div>
      <!-- <div class="text-center">
      <button onClick="startMeeting()" class="btn btn-primary">Online सत्र पाहण्यासाठी इथे click करा</button>
    </div> -->
<div class="aboutWrap">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="aboutLeft"> 
          <img class="img-fluid" src="{{asset('public/images/about-ganitalay.png')}}" alt="images"/>
        </div>
      </div>
      <div class="col-md-6">
        <div class="aboutRight">
          <h2><span>About</span><br/>
            Ganitalay</h2>
          <p>Ganitalay can be termed as a House (आलय) of Mathematics (गणित).</p>
          <p>There are multiple mathematical methods existing and different approaches towards mathematics. 'Ganitalay' focuses mainly on the aspect that the students should not feel agitated while solving their educational mathematics. The objective is to help students make friendship with Mathematics. This is because every student has an inherent fear of Mathematics right from childhood. Here mathematical fundamentals will be shared in very user-friendly way in simple terms so that it will create conducive environment to study mathematics in more simplified way. We cannot differentiate mathematics from any aspect of life. It is all pervasive. The vast repository of this mathematical knowledge is open for all participants. AANKNAAD subscribers and participant from MahaAanknaad competition get a free access to Ganitalay.</p>
          <p>Ganitalay membership has lifetime validity once joined. It is a virtual platform where participants are free to ask/raise their questions/queries in mathematics. Renowned Mathematicians and our subject experts will certainly solve/clarify discrepancy raised in the forum.</p>
          <div class="clear"></div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="featureWrap" style="background: #ccecf5;">
  <div class="container">
    <div class="row mobile-reverse">
       <div class="col-md-6">
        <div class="featureRight">
          <h2><span>Ganitalay</span><br/>ACTIVITIES</h2>
          <ul>
            <!-- <li>Every Ganitalay member can logged in with their unique logging ID and Password.</li>
            <li>Aanknaad App’s paid user and competition participants have access for Ganitalay with their User Name and Unique code of competition.</li>
            <li>Mentors can create content according to their subject.</li>
            <li>Students can follow their favourite mentor and their content.</li>
            <li>Students and mentors can interact with each other without any permission.</li>
            <li>Mentors can create their community regarding to their subject.</li>
            <li>We will create some content or arrange webinar or webinar series related to various aspects of mathematics.</li> -->
            <li>Webinar Series About Maths and Music, Dance, Folk Music</li>
            <li>Mathematical Activities</li>
            <li>Science Innovation Stories</li>
            <li>Scientist Stories</li>
            <li>Bhaskaracharya’s Lilavati Webinar Series</li>
            <li>Academicals and Non-Academicals Mathematics</li>
            <li>Applications of Mathematics in Day-to-Day Life</li>
          </ul>
          <div >
            <a class="btn btn-primary" href="{{url('login')}}">Sign In</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="featureLeft">
          <img class="img-fluid" src="{{asset('public/images/some-unique.png')}}" alt="images"/>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
<!-- </div>
<div class="clear"></div> -->
<!--end here-->
    <!-- </div> -->
  </div>
@endsection

@section("js_script")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://source.zoom.us/2.4.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.4.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.4.5/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.4.5/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.4.5/lib/vendor/lodash.min.js"></script>

    <!-- For Client View -->
    <script src="https://source.zoom.us/2.4.5/zoom-meeting-embedded-2.4.5.min.js"></script>
    <script type="text/javascript" >
      const client = ZoomMtgEmbedded.createClient()

let meetingSDKElement = document.getElementById('meetingSDKElement')

// setup your signature endpoint here: https://github.com/zoom/meetingsdk-sample-signature-node.js
var signatureEndpoint = ''
var sdkKey = '01AmxIKnqlJ4VGJTlQBNxIKfptWg64Kid7oY'
//var meetingNumber = '81047816382'
var meetingNumber ='84329162664'
var role = 0
var userName = 'Guest'
var userEmail = ''
var passWord = 'Aanknaad'
// pass in the registrant's token if your meeting or webinar requires registration. More info here:
// Meetings: https://marketplace.zoom.us/docs/sdk/native-sdks/web/component-view/meetings#join-meeting-with-registration-required
// Webinars: https://marketplace.zoom.us/docs/sdk/native-sdks/web/component-view/webinars#join-webinar-with-registration-required
var registrantToken = ''

client.init({
  zoomAppRoot: meetingSDKElement,
  language: 'en-US',
})

function getSignature() {
  fetch(signatureEndpoint, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      meetingNumber: meetingNumber,
      role: role
    })
  }).then((response) => {
    return response.json()
  }).then((data) => {
    console.log(data)
    startMeeting(data.signature)
  }).catch((error) => {
    console.log(error)
  })
}

function startMeeting(signature) {
  client.join({
    sdkKey: sdkKey,
    signature: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzZGtLZXkiOiIwMUFteElLbnFsSjRWR0pUbFFCTnhJS2ZwdFdnNjRLaWQ3b1kiLCJtbiI6Ijg0MzI5MTYyNjY0Iiwicm9sZSI6MCwiaWF0IjoxNjU2MTUwODc2LCJleHAiOjE2NTYxNTgwNzYsImFwcEtleSI6IjAxQW14SUtucWxKNFZHSlRsUUJOeElLZnB0V2c2NEtpZDdvWSIsInRva2VuRXhwIjoxNjU2MTU4MDc2fQ.ZX60Mq8hFGKt4_BCNtA6ASUK5yiT5Lixj-z-xnu4heQ",
    //signature:"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzZGtLZXkiOiIwMUFteElLbnFsSjRWR0pUbFFCTnhJS2ZwdFdnNjRLaWQ3b1kiLCJtbiI6Ijg0MzI5MTYyNjY0Iiwicm9sZSI6MCwiaWF0IjoxNjU2MDgyODI2LCJleHAiOjE2NTYwOTAwMjYsImFwcEtleSI6IjAxQW14SUtucWxKNFZHSlRsUUJOeElLZnB0V2c2NEtpZDdvWSIsInRva2VuRXhwIjoxNjU2MDkwMDI2fQ.PKkbKp86UTP6ZTZ9c_hbOfpf0xE3mb4MlOEeElzsYlk",
    meetingNumber: meetingNumber,
    password: passWord,
    userName: userName,
    userEmail: userEmail,
    tk: registrantToken
  })
}
    </script>
<script>
@if(Session::has('message'))
swal("error", "{{Session::get('message')}}", "error");
@php
Session::forget('message');
@endphp
@endif

</script>
@endsection
