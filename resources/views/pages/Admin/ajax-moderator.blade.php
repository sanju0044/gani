
 <table id="example" class="table table-striped table-bordered nowrap table-wrapper" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>City</th>

            <th style="width:134px;">Email</th>
            <th>Status</th>
            <th style="width:296px;">Action</th>
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
    <script>

$(document).ready(function() {
  $('#example').DataTable( {
            searching: false,
    });
} );

    </script>

