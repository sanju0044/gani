@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
<style>
    .table-wrapper {
        margin-top: 30px;
    }
</style>
<style>
    table.dataTable td {
        white-space: normal !important;
        word-wrap: break-word;
    }
</style>

<div class="container pd-20 card-box mb-30">
    <div class="row content-approval-dropdown-wrapper">
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
                <select name="content_type" id="content_type" class="form-control my-0 py-1 amber-border" style="display:none;">
                    <option value="Post" {{$content_type == "Post"?"selected":''}} >Post</option>
                </select>

                <div class="input-group-append"  style="display:none;">
                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true" style="color: #00a2cb"></i></span>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="row" id="div1">

        <table id="example" class="table table-striped table-bordered table-wrapper">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Post</th>
                    <th>Mentor</th>
                    <th style="width:134px;">Date & Time</th>
                    {{-- <th style="width:296px;">view</th> --}}
                </tr>
            </thead>
            <tbody>

                @foreach($data as $key=>$obj)
                                <tr id="tr-content-{{$obj->id}}">

                    <td>{{$obj->id}}</td>
                    <td>{!! $obj->description!!} <span style="color:#00a2cb !important;">- {{$obj->commentedBy->first_name}} {{$obj->commentedBy->last_name}}</span></td>
                    <td>{{$obj->mentor->first_name}} {{$obj->mentor->last_name}}</td>
                   
                     <td>{{$obj->created_at}}</td>
                   </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br><br><br>
@endsection

@push('scripts')

    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').removeAttr('width').DataTable({
                destroy: true, // <--- Add this line
                responsive: true,
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: true,
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                searching: true,
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
                url: "{{ url('admin/ajax-content-data1') }}",
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

