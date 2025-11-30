




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
                <a href="{{ url('admin/add-student') }}" class="btn btn-default"><i class="fas fa-plus"
                        style="color: #00a2cb"></i>Add Student</a>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-default"><i
                        class="fas fa-upload" style="color: #00a2cb"></i>Import Students</a>
                <a href="{{ url('admin/student/export-students') }}" class="btn btn-default"><i class="fas fa-download"
                        style="color: #00a2cb"></i>Export Students</a>
                <a href="{{ url('students.xlsx') }}" class="btn btn-default"><i class="fas fa-download"
                        style="color: #00a2cb"></i>Download Sample File</a>
            </div>
        </div>
        <br>
        <div class="row content-approval-dropdown-wrapper">
            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input class="form-control my-0 py-1 amber-border" name="search_standard" id="search_standard"
                        type="number" placeholder="Standard" aria-label="Search">
                    <div class="input-group-append">
                        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                aria-hidden="true" style="color: #00a2cb"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input class="form-control my-0 py-1 amber-border" name="search_age" id="search_age" type="number"
                        placeholder="Age" aria-label="Search">
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
        </div>

        <div class="row content-approval-dropdown-wrapper" style="margin-top:10px;">
            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <select name="state_id" id="state_id" class="form-control my-0 py-1 amber-border">
                        <option value="">States</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                        @endforeach
                    </select>

                   <!--  <div class="input-group-append">
                        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                aria-hidden="true" style="color: #00a2cb"></i></span>
                    </div> -->
                </div>
            </div>
            <div class="col-md-3" id="district-container">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <select name="district_id" id="district_id" class="form-control my-0 py-1 amber-border"
                        onchange="searchMentors()">
                        <option value="">District</option>
                    </select>
                    <!-- <div class="input-group-append">
                        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                aria-hidden="true" style="color: #00a2cb"></i></span>
                    </div> -->
                </div>
            </div>
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
            <div class="col-md-2" id="city-container">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <select name="city_id" id="city_id" class="form-control my-0 py-1 amber-border"
                        onchange="searchMentors()">
                        <option value="">City</option>
                    </select>
                    <!-- <div class="input-group-append">
                        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                aria-hidden="true" style="color: #00a2cb"></i></span>
                    </div> -->
                </div>
            </div>
            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle text-left dropdown-w" type="button"
                        data-toggle="dropdown">Paid Status
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)" onclick="setPaidStatus(1)">Yes</a></li>
                        <li><a href="javascript:void(0)" onclick="setPaidStatus(0)">No</a></li>
                    </ul>
                    <input type="hidden" name="paid_status" id="hidden-paid-status" />
                </div>
            </div>
        </div>
        <br>
        <div id="div1" class="table-responsive">

            <table id="student-table" class="table table-striped table-bordered nowrap table-wrapper" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Standard</th>
                        <th>City</th>
                        <th>Age</th>
                        <th style="width:134px;">Email</th>
                        <th>Paid User</th>
                        <th>Status</th>
                        <th>View Status</th>
                        <th style="width:296px;">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- @foreach ($data as $key => $obj)
                        <tr>
                            <td>{{ $obj->id }}</td>
                            <td>{{ $obj->first_name }} {{ $obj->last_name }}</td>
                            <td>{{ $obj->standard }}</td>
                            <td>{{isset($obj->cityModel)?$obj->cityModel->city_name:"NA"}}</td>
                            <td>{{ $obj->age }} Yr</td>
                            <td>{{ $obj->email }}</td>
                            <td>{{ $obj->status == '1' ? 'Active' : ($obj->status == '0' ? 'Inactive' : 'Deleted') }}</td>
                           
                            <td>
                                <a href="{{ url('admin/view-student/' . $obj->id) }}" class="btn btn-secondary">View</a>
                                <a href="{{ url('admin/edit-student/' . $obj->id) }}" class="btn btn-secondary">Edit</a>
                                @if ($obj->status != '4')
                                    <a onclick="return confirm('Are you sure to delete this student?')"
                                        href="{{ url('admin/delete-student/' . $obj->id) }}"
                                        class="btn btn-secondary">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach -->

                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Import Students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/admin/student/import-students') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Upload File</label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required
                                    name="student_file" type="file" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js_script')
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>

        $(document).ready( function () {
            $('#student-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/student-list') }}",
                destroy: true,
                columns: [
                            { data: 'DT_RowIndex', name: 'id' },
                            { data: 'first_name', name: 'first_name' },
                            { data: 'id', name: 'id' },
                            { data: 'standard', name: 'standard' },
                            { data: 'city', name: 'city' },
                            { data: 'age', name: 'age' },
                            { data: 'email', name: 'email' },
                            { data: 'paid_user', name: 'paid_user' },
                            { data: 'status', name: 'status' },
                            { data: 'view_status', name: 'view_status' },
                            { data: 'action', name: 'action' },
                           
                        ]
            });

            // 
        });

        // $(document).ready(function() {
        //     $('#example').DataTable({
        //         searching: false,
        //         serverSide: true,
        //     });
        // });
        @if (Session::has('message'))
            swal("success", "{{ Session::get('message') }}", "success");
            @php
                Session::forget('message');
            @endphp
        @endif

        @if (Session::has('import_response'))
            swal("Student imported", "Total: {{ Session::get('import_response')['total'] }}, New:
            {{ Session::get('import_response')['new'] }}, Updated: {{ Session::get('import_response')['updated'] }}",
            "success");
            @php
                Session::forget('import_response');
            @endphp
        @endif

        function setStatus(val) {
            $("#hidden-status").val(val);
            searchMentors();
        } 
        function setPaidStatus(val) {
            $("#hidden-paid-status").val(val);
            searchMentors();
        }

        $("#search_name, #search_email, #search_age, #search_standard").keyup(function() {
            searchMentors();
        });

        $("#state_id").change(function() {
            $.ajax({
                url: "{{ url('admin/ajax-get-district-data') }}",
                data: {
                    state_id: $("#state_id").val(),
                },
                success: function(result) {
                    $("#district-container").html(result);
                }
            });

            searchMentors();
        });



        function searchMentors() {

            $.ajax({
                url: "{{ url('admin/ajax-student-data') }}",
                data: {
                    name: $("#search_name").val(),
                    email: $("#search_email").val(),
                    status: $("#hidden-status").val(),
                    standard: $("#search_standard").val(),
                    age: $("#search_age").val(),
                    state_id: $("#state_id").val(),
                    city_id: $("#city_id").val(),
                    district_id: $("#district_id").val(),
                    paid_status:$("#hidden-paid-status").val(),
                },
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        }

        function getCity(ele) {
            $.ajax({
                url: "{{ url('admin/ajax-get-city-data') }}",
                data: {
                    district_id: $("#district_id").val(),
                },
                success: function(result) {
                    $("#city-container").html(result);
                }
            });

            searchMentors();

        }
    </script>
@endsection
