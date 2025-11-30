@extends('layouts.app')

@section('content')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .table-wrapper {
            margin-top: 30px;
        }

    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-4 text-right profile-button-wrapper">
                <a href="{{ url('admin/add-mentor') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Add Mentor</a>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-warning"><i
                    class="fas fa-upload" style="color: #00a2cb"></i>Import Mentors</a>
                <a href="{{ url('/admin/student/export-mentors') }}" class="btn btn-success"><i class="fas fa-download" style="color: #00a2cb"></i>Export Mentors</a>
                <a href="{{ url('mentors.xlsx') }}" class="btn btn-danger"><i class="fas fa-download"
                        style="color: #00a2cb"></i>Download Sample File</a>
            </div>
        </div>
        <br>
        <div class="pd-20 card-box mb-30">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="search_name" class="form-control" placeholder="Search by Name">
                </div>
                <div class="col-md-3">
                    <input type="text" id="search_email" class="form-control" placeholder="Search by Email">
                </div>
                <div class="col-md-3">
                    <select name="status" id="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Deleted">Deleted</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="senior_status" id="senior_status" class="form-control">
                        <option value="">Select Senior Status</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- <div class="row content-approval-dropdown-wrapper">
            <div class="col-md-3">
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
                        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey" style="color: #00a2cb"
                                aria-hidden="true"></i></span>
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

            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle text-left dropdown-w" type="button"
                        data-toggle="dropdown">Senior Mentor
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)" onclick="setSeniorStatus(1)">Yes</a></li>
                        <li><a href="javascript:void(0)" onclick="setSeniorStatus(0)">No</a></li>
                    </ul>
                    <input type="hidden" name="senior_status" id="hidden-senior-status" />
                </div>
            </div>

        </div> --}}

        <br>
        <div class="card-box mb-30 p-2">
            <table id="example" class="table hover stripe  data-table-export">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Senior Mentor</th>
                        <th>Mentor Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $obj)
                        <tr>
                            <td>{{ $obj->id }}</td>
                            <td>{{$obj->first_name}} {{$obj->last_name}} </td>
                            <td>{{isset($obj->cityModel)?$obj->cityModel->city_name:"NA"}}</td>
                            <td>{{ $obj->email }}</td>
                            <td>{{ $obj->senior_mentor == '1' ? 'Yes' : 'No' }}</td>
                            @if($obj->mentor_type == 1)
                            <td> Local</td>
                            @elseif($obj->mentor_type == 2)
                            <td> Academician</td>
                                @elseif($obj->mentor_type == 3)
                                <td>National/International</td>
                                @else
                                <td>Exclusive</td>
                            @endif 
                        <td>{{ $obj->status == '1' ? 'Active' : ($obj->status == '0' ? 'Inactive' : 'Deleted') }}</td>   
                            <td>
                                <a href="{{ url('admin/view-mentor/' . $obj->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ url('admin/edit-mentor/' . $obj->id) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                @if ($obj->status != '4')
                                    <a onclick="return confirm('Are you sure to delete this mentor?')"
                                        href="{{ url('admin/delete-mentor/' . $obj->id) }}"
                                        class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><br><br><br>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Import Mentors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/admin/mentor/import-mentor') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <label>Upload File</label>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required
                                name="mentor_file" type="file" />
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

    {{-- <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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

        function setSeniorStatus(val) {
            $("#hidden-senior-status").val(val);
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
                url: "{{ url('admin/ajax-mentor-data') }}",
                data: {
                    name: $("#search_name").val(),
                    email: $("#search_email").val(),
                    status: $("#hidden-status").val(),
                    senior_status:$("#hidden-senior-status").val(),
                },
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        }
    </script>
@endsection
