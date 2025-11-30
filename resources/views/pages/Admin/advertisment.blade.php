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
            <a href="{{url('admin/add-advertisment')}}" class="btn btn-default"><i class="fas fa-plus" style="color: #00a2cb"></i>Add Advertisment</a>
            {{-- <a href="{{ url('/admin/student/export-moderators') }}" class="btn btn-default"><i class="fas fa-download"
                        style="color: #00a2cb"></i>Export Moderators</a> --}}
        </div>
    </div>
    <br>
    <div class="row content-approval-dropdown-wrapper">


      
        
       
    </div>

    <br>
    <div id="div1">

    <table id="example" class="table table-striped table-bordered nowrap table-wrapper" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Advertisment Image 1 </th>
                <!-- <th>Advertisment Image 2</th> -->
                <th>Status</th>
                <th style="width:296px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key=>$obj)
            <tr>
                <td>{{$obj->id}}</td>
                <td>
                    <img src="{{ URL::to('/') }}/images/{{ $obj->profile_picture }}"
                        style="width:50%" height="251px" id="profile-image-preview" alt="profile-image" />
               </td>
                <!-- <td><img src="{{ URL::to('/') }}/storage/images/{{ $obj->profile_picture1 }}"
                    style="width:50%" height="251px" id="profile-image-preview" alt="profile-image" />
          </td> -->
               <td>{{($obj->status=='0')?'Active':(($obj->status=='1')?'Inactive':"InActive")}}</td>
                <td>
                   {{$obj->status}}
                    <a href="{{url('admin/edit-advertisment/'.$obj->id)}}" class="btn btn-secondary">Edit</a>
                    @if($obj->status!='4')
                    <a onclick="return confirm('Are you sure to delete advertisment ?')" href="{{url('admin/delete-advertisment/'.$obj->id)}}" class="btn btn-secondary">Delete</a>
                    @endif
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    </div>
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

