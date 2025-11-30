
<table id="example" class="table table-striped table-bordered nowrap table-wrapper" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>user_name</th>
            <th>Student ID</th>
            <th>Standard</th>
            <th>City</th>
            <th>Age</th>
            <th style="width:134px;">Email</th>
            <th>Paid User</th>
            <th>Status</th>
            <th style="width:296px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key=>$obj)
            <tr>
                <td>{{$obj->id}}</td>
                <td>{{$obj->first_name}} {{$obj->last_name}}</td>
                <td>{{$obj->id}}</td>
                <td>{{$obj->user_name}}</td>
                <td>{{$obj->standard}}</td>
                <td>{{isset($obj->cityModel)?$obj->cityModel->city_name:"NA"}}</td>
                <td>{{$obj->age}} Yr</td>
                <td>{{$obj->email}}</td>
                <td>{{ $obj->paid_user == '1' ? 'Yes' : 'No' }}</td>
                <td>{{($obj->status=='1')?'Active':(($obj->status=='0')?'Inactive':"Deleted")}}</td>
                {{-- <td>{{($obj->view_status=='0')?'Active':(($obj->view_status=='1')?'Inactive':"InActive")}}</td> --}}
                
                <td>
                    <a href="{{url('admin/view-student/'.$obj->id)}}" class="btn btn-secondary">View</a>
                    <a href="{{url('admin/edit-student/'.$obj->id)}}" class="btn btn-secondary">Edit</a>
                    @if($obj->status!='4')
                    <a onclick="return confirm('Are you sure to delete this student?')" href="{{url('admin/delete-student/'.$obj->id)}}" class="btn btn-secondary">Delete</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            searching: false,
            destroy: true,
        });
    });
</script>