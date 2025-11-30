@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
<style>
    .table-wrapper {
        margin-top: 30px;
    }
</style>

<div class="container">
    <div class="row content-approval-dropdown-wrapper">

        @if(Auth::user()->user_type!=2)
        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="moderator_id" id="moderator_id" class="form-control my-0 py-1 amber-border">
                    <option value="">Moderator</option>
                    @foreach($moderators as $moderator)
                    <option value="{{$moderator->id}}">{{$moderator->first_name}} {{$moderator->last_name}}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true" style="color: #00a2cb"></i></span>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="mentor_id" id="mentor_id" class="form-control my-0 py-1 amber-border">
                    <option value="">Mentor</option>
                    @foreach($mentors as $mentor)
                    <option value="{{$mentor->id}}">{{$mentor->first_name}} {{$mentor->last_name}}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true" style="color: #00a2cb"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="content_type" id="content_type" class="form-control my-0 py-1 amber-border">
                    <option value="Post" {{$content_type == "Post"?"selected":''}} >Post</option>
                    <option value="Q&A" {{$content_type == "Q&A"?"selected":''}}>Q&A</option>
                    <option value="Comment" {{$content_type == "Comment"?"selected":''}}>Comment</option>

                </select>

                <div class="input-group-append">
                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true" style="color: #00a2cb"></i></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="status" id="status" class="form-control my-0 py-1 amber-border">
                    <option value="">Status</option>
                    <option value="0" {{$status == "0"?"selected":''}}>Pending</option>
                    <option value="1" {{$status == "1"?"selected":''}}>Approved</option>
                    <option value="2" {{$status == "2"?"selected":''}}>Disapproved</option>

                </select>

                <div class="input-group-append">
                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true" style="color: #00a2cb"></i></span>
                </div>
            </div>
        </div>

    </div>

    <br>
    <div class="card-box mb-30 p-2">
        <div class="row table-responsive" id="div1">
            <table id="example" class="table hover stripe multiple-select-row data-table-export">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Post / Comment / Q&A</th>
                        <th>Mentor</th>
                        <th>Moderator</th>
                        <th>Content Type</th>
                        <th>Video URL</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$obj)
                    <tr id="tr-content-{{$obj->id}}">
                        <td>{{$obj->id}}</td>
                        <td>{!! $obj->description!!} <span style="color:#00a2cb !important;">- {{$obj->commentedBy->first_name}} {{$obj->commentedBy->last_name}}</span></td>
                        <td>{{$obj->mentor->first_name}} {{$obj->mentor->last_name}}</td>
                        <td>{{$obj->approved_by?$obj->moderator->first_name." ".$obj->moderator->last_name:"NA"}}</td>
                        <td>Post</td>
                        {{--<?php echo "AAA:<pre>";print_r($obj->mentor->video);exit; ?>--}}
                        <td>{{$obj->mentor->video}}</td>
                        <td>{{$obj->created_at}}</td>
                        <td id="post-status-{{$obj->id}}">{{$obj->status=='0'? 'Pending':($obj->status=='1'?"Approved":"Disapproved")}}</td>
                        <td>
                            <a href="{{url('admin/content-approval1/detail/'.$obj->id)}}" class="btn btn-primary">View</a>
                            <a href="{{url('admin/edit/comment/'.$obj->id)}}" class="btn btn-warning">Edit Post</a>
                            @if($obj->status=='0')
                            <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="approvePost({{$obj->id}})"  href="javascript:void(0)">Approve</a>
                            <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="disapprovePost({{$obj->id}})" href="javascript:void(0)"   >Disapprove</a>

                            @endif
                        <a class="btn btn-danger btn-post-{{$obj->id}}" onclick="deletePost({{$obj->id}})" href="javascript:void(0)">Delete</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').removeAttr('width').DataTable({
                searching: false,
                columnDefs: [
            { width: 200, targets: 0 }
        ],
        fixedColumns: true
            });
        });
        @if (Session::has('message'))
            swal("success", "{{ Session::get('message') }}", "success");
            @php
                Session::forget('message');
            @endphp
        @endif

        $("#moderator_id, #mentor_id, #content_type, #status").change(function() {
            searchContent();
        });



        function searchContent() {

            $.ajax({
                url: "{{ url('admin/ajax-content-data') }}",
                data: {
                    moderator_id: $("#moderator_id").val(),
                    mentor_id: $("#mentor_id").val(),
                    content_type: $("#content_type").val(),
                    status: $("#status").val(),

                },
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        }


        function approvePost(post_id) {

            if(!confirm('Are you sure to approve this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/approve') }}",
                data: {
                    post_id: post_id,
                },
                success: function(result) {
                    $(".btn-post-"+post_id).hide();
                    $("#post-status-"+post_id).text("Approved");
                    swal("success", "Content approved successfully!", "success");
                }
            });
        }

                function deletePost(post_id) {

            if(!confirm('Are you sure to delete this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/delete') }}",
                data: {
                    post_id: post_id,
                },
                success: function(result) {
                    $("#tr-content-"+post_id).hide();
                    swal("success", "Content deleted successfully!", "success");
                }
            });
        }
        function deleteQnA(id) {

            if(!confirm('Are you sure to delete this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/delete-question') }}",
                data: {
                    id: id,
                },
                success: function(result) {
                    $("#tr-content-"+id).hide();
                    swal("success", "Content deleted successfully!", "success");
                }
            });
        }

        function deleteComment(id) {

            if(!confirm('Are you sure to delete this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/delete-comment') }}",
                data: {
                    id: id,
                },
                success: function(result) {
                    $("#tr-content-"+id).hide();
                    swal("success", "Content deleted successfully!", "success");
                }
            });
        }


        function approveQuestion(question_id) {

            if(!confirm('Are you sure to approve this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/approve-question') }}",
                data: {
                    question_id: question_id,
                },
                success: function(result) {
                    $(".btn-post-"+question_id).hide();
                    $("#post-status-"+question_id).text("Approved");
                    swal("success", "Content approved successfully!", "success");
                }
            });
        }

        function approveComment(comment_id) {

            if(!confirm('Are you sure to approve this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/approve-comment') }}",
                data: {
                    comment_id: comment_id,
                },
                success: function(result) {
                    $(".btn-post-"+comment_id).hide();
                    $("#post-status-"+comment_id).text("Approved");
                    swal("success", "Content approved successfully!", "success");
                }
            });
        }
        function disapproveComment(comment_id) {

            if(!confirm('Are you sure to approve this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/disapprove-comment') }}",
                data: {
                    comment_id: comment_id,
                },
                success: function(result) {
                    $(".btn-post-"+comment_id).hide();
                    $("#post-status-"+comment_id).text("Disapproved");
                    swal("success", "Content disapproved successfully!", "success");
                }
            });
        }
        function disapproveQuestion(question_id) {

            if(!confirm('Are you sure to approve this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/disapprove-question') }}",
                data: {
                    question_id: question_id,
                },
                success: function(result) {
                    $(".btn-post-"+question_id).hide();
                    $("#post-status-"+question_id).text("Disapproved");
                    swal("success", "Content disapproved successfully!", "success");
                }
            });
        }

        function disapprovePost(post_id) {

            if(!confirm('Are you sure to disapprove this content?'))
            {
                return;
            }
            $.ajax({
                url: "{{ url('admin/content-approval1/disapprove') }}",
                data: {
                    post_id: post_id,
                },
                success: function(result) {
                    $(".btn-post-"+post_id).hide();
                    $("#post-status-"+post_id).text("Disapproved");
                    swal("success", "Content disapproved successfully!", "success");
                }
            });
        }

        @if($filterFlag)
        $(function(){
            searchContent();
        })
        @endif
    </script>
@endpush

