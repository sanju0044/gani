@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
<style>
    .table-wrapper {
        margin-top: 30px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-4 text-right profile-button-wrapper">
            <a href="{{url('admin/add-moderator')}}" class="btn btn-outline-primary"><i class="fas fa-plus" style="color: #00a2cb"></i>Add Moderator</a>
            <a href="{{ url('/admin/student/export-moderators') }}" class="btn btn btn-outline-success"><i class="fas fa-download"
                        style="color: #00a2cb"></i>Export Moderators</a>
        </div>
    </div>
    <br>
    <div class="pd-20 card-box mb-30">
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="search_name" class="form-control" placeholder="Search by Name">
            </div>
            <div class="col-md-4">
                <input type="text" id="search_email" class="form-control" placeholder="Search by Email">
            </div>
            <div class="col-md-4">
                <select name="status" id="status" class="form-control">
                    <option value="">Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    <option value="4">Deleted</option>
                </select>
            </div>
        </div>
    </div>

    {{-- <div class="row content-approval-dropdown-wrapper">
        <div class="col-md-2">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle text-left dropdown-w" type="button"
                    data-toggle="dropdown">Status
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)" onclick="setStatus(1)">Active</a></li>
                    <li><a href="javascript:void(0)" onclick="setStatus(0)">Inactive</a></li>
                    <li><a href="javascript:void(0)" onclick="setStatus(4)">Deleted</a></li>
                </ul>
                <input type="hidden" name="status" id="hidden-status" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 amber-border" name="search_name" id="search_name" type="text"
                    placeholder="Name" aria-label="Search">
                <div class="input-group-append">
                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true" style="color: #00a2cb"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 amber-border" type="text" id="search_email" name="search_email"
                    placeholder="Email" aria-label="Search">
                <div class="input-group-append">
                    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true" style="color: #00a2cb"></i></span>
                </div>
            </div>
        </div>
    </div> --}}

    <br>
    <div id="div1">
        <div class="card-box mb-30 p-2">
            <table id="example" class="table hover stripe data-table-export nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Approval Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$obj)
                    <tr>
                        <td>{{$obj->id}}</td>
                        <td>{{$obj->first_name}} {{$obj->last_name}}</td>
                        <td>{{$obj->city}}</td>
                        <td>{{$obj->email}}</td>
                        <td>{{($obj->status=='1')?'Active':(($obj->status=='0')?'Inactive':"Deleted")}}</td>
                        @if($obj->moderator_type == 1)
                        <td> Post</td>
                        @elseif($obj->moderator_type == 2)
                        <td> Q/A</td>
                        @elseif($obj->moderator_type == 3)
                        <td>Comments</td>
                        @else
                        <td>none</td>
                        @endif 
                        <td>
                            <a href="{{url('admin/view-moderator/'.$obj->id)}}" class="btn btn-secondary">View</a>
                            <a href="{{url('admin/edit-moderator/'.$obj->id)}}" class="btn btn-secondary">Edit</a>
                            @if($obj->status!='4')
                            <a onclick="return confirm('Are you sure to delete this moderator?')" href="{{url('admin/delete-moderator/'.$obj->id)}}" class="btn btn-secondary">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div><br><br><br>
</div>

@endsection

@section('js_script')

    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
            });
        });
        @if (Session::has('message'))
            swal("success", "{{ Session::get('message') }}", "success");
            @php
                Session::forget('message');
            @endphp
        @endif

        function setStatus(val) {
            $("#hidden-status").val(val);
            searchMentors();
        }

        $("#search_name").keyup(function() {
            searchMentors();
        });

        $("#search_email").keyup(function() {
            searchMentors();
        });

        function searchMentors() {
            $.ajax({
                url: "{{ url('admin/ajax-moderator-data') }}",
                data: {
                    name: $("#search_name").val(),
                    email: $("#search_email").val(),
                    status: $("#hidden-status").val(),
                },
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        }
    </script>
    

@endsection

