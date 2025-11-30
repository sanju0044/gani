@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<style>
    .table-wrapper {
        margin-top: 30px;
    }
    div#activity-logs-table_length {
	    margin-right: 20px;
	}
</style>

<div class="container">

	    <div class="row content-approval-dropdown-wrapper card-box mb-30 p-3 mb-4">
            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0">
                   <input class="form-control input-daterange-datepicker" type="text" name="daterange"
                     value="{{ $startDate->format('d-m-Y') . ' - ' . $endDate->format('d-m-Y') }}" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <select name="state_id" id="user_type" class="form-control my-0 py-1 amber-border">
                        <option value="0">Select User Type</option>
                        <option value="3">Mentor</option>
                        <option value="4">Student</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <select name="state_id" id="user" class="form-control my-0 py-1 amber-border">
                        <option value="0">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <select name="state_id" id="activity_type" class="form-control my-0 py-1 amber-border">
                        <option value="0">Select Activity Type</option>
                        @foreach ($activity_types as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0 mt-4">
                    <select name="state_id" id="state_id" class="form-control my-0 py-1 amber-border">
                        <option value="0">Select States</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group md-form form-sm form-2 pl-0 mt-4">
                    <input class="form-control my-0 py-1 amber-border" name="search_pin_code" id="search_pin_code" type="text"
                        placeholder="Pin Code" aria-label="Search">
                    <div class="input-group-append">
                        <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                aria-hidden="true" style="color: #00a2cb"></i></span>
                    </div>
                </div>
            </div>

        </div>

	<div class="row">
		<div class="col-md-12 card-box mb-30 p-3">
			<table id="activity-logs-table" class="table hover stripe data-table-export nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>User Type</th>
                        <th>Activity Type</th>
                        <th>Activity</th>
                        <th>Date Time</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
		</div>
	</div>
</div>
<br>
<br>
<br>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>
    	var startDate = '{{ $startDate->format('Y-m-d') }}';
        var endDate = '{{ $endDate->format('Y-m-d') }}';
        $(document).ready( function () {

        	$('.input-daterange-datepicker').daterangepicker({
		        buttonClasses: ['btn', 'btn-sm'],
		        cancelClass: 'btn-inverse',
		        "locale": {
		            format: 'DD/MM/YYYY'
		        }
		    })

            $("select").select2();

        	tableLoad();
            var table;
            $('#user,#activity_type,#state_id').change(function() { 
              tableLoad();
            });

            $('#user_type').change(function() {
              var user_type = $('#user_type').val();
              $.ajax({
                url:'{{ url('/admin/get-user-by-type') }}',
                type:'GET',
                data:{
                    user_type:user_type
                },
                success:function(response,textStatus,xhr){
                    console.log(response.users_list)
                    if(xhr.status==200){
                        $('#user').html(response.users_list);
                    }else{
                        $('#user').html('');
                    }
                },
                error:function(error){
                    console.log(error);
                    $('#user').html('');
                },
                complete:function(){
                    tableLoad();
                }
              });
            });

            $("#search_pin_code").keyup(function() {
                tableLoad();
            });

            $('.input-daterange-datepicker').on('apply.daterangepicker', function(ev, picker) {
                startDate = picker.startDate.format('YYYY-MM-DD');
                endDate = picker.endDate.format('YYYY-MM-DD');
                tableLoad();
            });
        });

     	tableLoad = () => {
     		var user_type = $('#user_type').val();
     		var user_id = $('#user').val();
     		var activity_type = $('#activity_type').val();
            var state_id = $('#state_id').val();
            var pin_code = $('#search_pin_code').val();

     		table=$('#activity-logs-table').DataTable({
	            responsive: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                dom: 'lBfrtip',
              	buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
		        ],
                paging: true,
                destroy: true,
                order: [[5, 'desc']],
                ajax: "{{ url('/admin/activity-logs-data') }}?"+'start_date=' + startDate + '&end_date=' + endDate+ '&user_type=' + user_type+ '&user_id=' + user_id+ '&activity_type=' + activity_type+ '&state_id=' + state_id+ '&pin_code=' + pin_code,
                columns: [
                    { data: 'DT_RowIndex', name: 'id' },
                    { data: 'user_name', name: 'user.first_name' },
                    { data: 'user_type', name: 'user.user_type' },
                    { data: 'activity_type_name', name: 'activity_type_info.type' },
                    { data: 'text', name: 'text' },
                    { data: 'created_at', name: 'created_at' }
                ]
            });
     	}

    </script>
@endpush
