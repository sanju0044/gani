
<table id="example" class="table table-striped table-bordered nowrap table-wrapper" style="width:100%">
        <thead>
            <tr>
                <th style="width:10%" >ID</th>
                <th style="width:20%">Name</th>
                <th style="width:10%">City</th>

                <th style="width:20%;">Email</th>
                <th style="width:20%;">Senior Mentor</th>
                <th style="width:10%;">Status</th>
                <th style="width:30%;">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($data as $key=>$obj)
            <tr>
                <td>{{$obj->id}}</td>
                <td>{{$obj->first_name}} {{$obj->last_name}} </td>
                <td>{{isset($obj->cityModel)?$obj->cityModel->city_name:"NA"}}</td>
                <td>{{$obj->email}}</td>
                 <td>{{ $obj->senior_mentor == '1' ? 'Yes' : 'No' }}</td>
                <td>{{($obj->status=='1')?'Active':(($obj->status=='0')?'Inactive':"Deleted")}}</td>
                <td>
                    <a href="{{url('admin/view-mentor/'.$obj->id)}}" class="btn btn-secondary">View</a>
                    <a href="{{url('admin/edit-mentor/'.$obj->id)}}" class="btn btn-secondary">Edit</a>
                    @if($obj->status!='4')
                    <a onclick="return confirm('Are you sure to delete this mentor?')" href="{{url('admin/delete-mentor/'.$obj->id)}}" class="btn btn-secondary">Delete</a>
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

