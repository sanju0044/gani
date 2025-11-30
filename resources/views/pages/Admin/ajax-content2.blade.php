<table id="example" class="table table-striped table-bordered nowrap table-wrapper">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post</th>
            <th>Mentor</th>
            <th style="width:134px;">Date & Time</th>
              </tr>
    </thead>
    <tbody>

        @foreach ($data as $key => $obj)
                      <tr id="tr-content-{{$obj->id}}">
                <td>{{ $obj->id }}</td>
                @if($content_type == "Post")
                <td>{!! $obj->description!!}- <span style="color: #00a2cb !important;"><?php if(isset($obj->commentedBy->first_name)){Print_r($obj->commentedBy->first_name);Print_r($obj->commentedBy->last_name);} ?></span></td>
                @elseif($content_type == "Q&A")
                <td>{{ $obj->question }}</td>
                @else
                <td>{{ $obj->comment }} - <span style="color: #00a2cb !important;"><?php if(isset($obj->user->first_name)){Print_r($obj->user->first_name);Print_r($obj->user->last_name);} ?></span></td>
                @endif

                @if(isset($obj->mentor))
                <td>{{ $obj->mentor->first_name }} {{ $obj->mentor->last_name }}</td>
                @else
                <td>N/A</td>
                @endif

                  <td>{{ $obj->created_at }}</td>
                  
            </tr>
        @endforeach
    </tbody>
</table>




<script>
    $(document).ready(function() {
        $('#example').DataTable({
            searching: false,
        });
    });
</script>
