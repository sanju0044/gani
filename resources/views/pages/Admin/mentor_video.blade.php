@extends('layouts.app') @section('content')
<style>
    .small-box > .small-box-footer {
        background: none;
        color: black;
        text-decoration: underline;
    }
    
    .profile-name-section-1 h3 {
        color: #000;
    }
    .profile-name-section-1 p {
        color: #00000085;
        margin-top: -9px;
    }
    .show-profile-wrapper {
        background: #00a2cb;
        color: #ffff;
        padding: 13px;
        margin-bottom: 25px;
    }
    @media only screen and (min-width: 321px) and (max-width: 767px){
        a.nav-link.login-text{
            margin-left: 39%;
        }
        .mentor-name{
            text-align: center;
        }
    }
</style>
<div class="container">
    <div class="tab-content">
        <div id="menu2" >
            <div class="row d-flex flex-wrap align-items-center gallery-images-wrapper">
                <div class="col-md-12 col-12">
                @foreach($mentor_video as $obj)
                            <iframe width="420" height="345" src="{{ $obj }}"></iframe>
                       @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_script')
    <script>
    </script>
@endsection
