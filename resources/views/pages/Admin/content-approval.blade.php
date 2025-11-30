@extends('layouts.app')
 
@section('content')
<style>
    .table-wrapper {
        margin-top: 30px;
    }
</style>
<div class="container" style="margin-top:25px;">
    <div class="row content-approval-dropdown-wrapper">
            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle dropdown-w" type="button" data-toggle="dropdown">Mentors
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle dropdown-w" type="button" data-toggle="dropdown">Moderators
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Select</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle dropdown-w" type="button" data-toggle="dropdown">Content Type
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle dropdown-w" type="button" data-toggle="dropdown">Status
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
            </div>
    </div>
    <div class="row">
    <table id="example" class="table table-striped table-bordered nowrap table-wrapper" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Post / Comment / Q&A</th>
                <th>Mentor</th>
                <th>Moderator</th>
                <th style="width:134px;">Content Type</th>
                <th style="width:134px;">Date & Time</th>
                <th>Status</th>
                <th style="width:296px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut nec sapien nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus.</td>
                <td>Raghunath</td>
                <td>Anupam</td>
                <td>Post</td>
                <td>09:30 AM,4 Jan 20222</td>
                <td>$112,000</td>
                <td>
                    <button class="btn btn-secondary">View</button>
                    <button class="btn btn-secondary">Approved</button>
                    <button class="btn btn-secondary">Disapproved</button>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>

@endsection