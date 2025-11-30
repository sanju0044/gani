@extends('layouts.app')

@section('content')
<style>

</style>
<div class="card">
    <div class="row">
        <div class="col-md-3 col-xs-2 col-sm-2 col-lg-3">
            <div class="profile-wrapper">
                <div class="profile-image-wrapper text-center">
                    @if (Auth::user()->profile_picture == null)
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="100" height="100">
                    @else
                    <img src="{{URL::to('/')}}/storage/images/{{ Auth::user()->profile_picture }}" width="100" height="100">

                    @endif
                </div>
                <div class="text-center">
                    <div><h3>{{ucfirst(Auth::user()->first_name)}} {{ucfirst(Auth::user()->last_name)}}</h3></div>
                    <div><p>{{ucfirst(Auth::user()->city)}}</p></div>
                    <div><p>{{ucfirst(Auth::user()->standard)}} Standard</p></div>
                </div>
                <div class="text-center profile-image-div-third">
                    <div>
                        <a type="button" class="btn button-first">Interest 1</a>
                    </div>
                    <div>
                        <a type="button" class="btn button-second">Interest 2</a>
                    </div>
                    <div>
                        <a type="button" class="btn button-third">Interest 3</a>
                    </div>
                    <div>
                        <a type="button" class="btn button-first">Interest 3</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6 second-section-wrapper">
            <div class="text-center dropdown-section background-color-white">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Standard
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Subjects
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Language
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="col-md-3 col-xs-4 col-sm-4 col-lg-3 third-section-wrapper">
            <div class="row">
                <div class="col-md-12 col-12">
                    <img src="{{asset('images/advertise.png')}}">
                </div>
                <div class="col-md-12 col-12" style="padding-top:20px;">
                    <img src="{{asset('images/advertise-2.png')}}" width="250" height="250">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
