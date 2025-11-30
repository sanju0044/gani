@extends('layouts.app') 

@section('content')

<div class="container">
    <div class="row">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" tabindex="-1" href="#">Answered</a>
            </li>
        </ul>
    </div>
</div>

@endsection