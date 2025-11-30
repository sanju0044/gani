@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />

    <style>
        .table-wrapper {
            margin-top: 30px;
        }
        .profile-name-section-1{
            color: #000;
        }
    </style>
    

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-4 text-right profile-button-wrapper">
                <a href="{{ url('admin/add-vedio') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Add URL</a>
            </div>
        </div>
        <br>
        <div id="div1">
            <div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Video Conference</h4>
					</div>
					<div class="pb-20">
						<table class="table hover stripe data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">ID</th>
									<th>Embedded Url</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                @foreach($allvedio as $key=>$obj)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $obj->url }}</td>
                                        <td>
                                        <?php if($obj->status == 1){
                                                echo "Active";
                                            }elseif($obj->status == 0){
                                                echo "Deactive";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                        
                                            <a class="btn btn-warning btn-post-{{$obj->id}}" onclick="approveProject({{$obj->id}})"  href="javascript:void(0)">Active</a>
                                        
                                            <a class="btn btn-secondary btn-post1-{{$obj->id}}" onclick="dispproveProject({{$obj->id}})" href="javascript:void(0)">Deactive</a>
                                        
                                        </td>
                                    </tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
           
        </div>
    </div>
    </br></br></br>
@endsection

@push('scripts')

    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
     <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
               // order:[[0, 'DESC']]
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
        function approveProject(idetor_id) {
            // alert(idetor_id);
        if(!confirm('Are you sure to Active?'))
        {
            return;
        }
        $.ajax({
            url: "{{ url('/admin/Video-Conference/approve') }}",
            data: {
                idetor_id: idetor_id,
            },
           
            success: function(result) {
                $(".btn-post-"+idetor_id).hide();
                $(".btn-post1-"+idetor_id).show();
                location.reload(true);
                $("#post-status-"+idetor_id).text("Approved");
                swal("success", "Project Approved successfully!", "success");
            }
         
        });
        }

        function dispproveProject(idetor_id) {
        if(!confirm('Are you sure to Deactive?'))
        {
            return;
        }
        $.ajax({
            url: "{{ url('/admin/Video-Conference/disapprove') }}",
            data: {
                idetor_id: idetor_id,
            },
            success: function(result) {
            $(".btn-post1-"+idetor_id).hide();
                $(".btn-post-"+idetor_id).show();
                location.reload(true);
               $("#post-status-"+idetor_id).text("Disapproved");
                swal("success", "Project disapproved successfully!", "success");
            }
        });
        }
    </script>
@endpush
