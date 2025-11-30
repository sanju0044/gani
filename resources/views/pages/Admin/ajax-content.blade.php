<table id="example" class="table table-striped table-bordered nowrap table-wrapper">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post / Comment / Q&A</th>
            <th>Mentor</th>
            <th>Moderator</th>
            <th style="width:134px;">Content Type</th>
            <th style="width:134px;">Date & Time</th>
            <th>Status</th>
            <th style="width:296px;">Action</th>
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

                <td>{{ $obj->approved_by ? $obj->moderator->first_name . ' ' . $obj->moderator->last_name : 'NA' }}</td>
                <td>{{$content_type}}</td>
                <td>{{ $obj->created_at }}</td>
                <td id="post-status-{{$obj->id}}">{{ $obj->status == '0' ? 'Pending' : ($obj->status == '1' ? 'Approved' : 'Disapproved') }}</td>
                <td>

                    @if($content_type == "Post")
                    <a href="{{ url('admin/content-approval1/detail/' . $obj->id) }}" class="btn btn-secondary">View</a>
                    <a href="{{url('admin/edit/comment/'.$obj->id)}}" class="btn btn-secondary">Edit Post</a>
                    @if ($obj->status == '0')
                        <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="approvePost({{$obj->id}})"  href="javascript:void(0)">Approve</a>
                        <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="disapprovePost({{$obj->id}})" href="javascript:void(0)" >Disapprove</a>
                        @endif
                                            <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="deletePost({{$obj->id}})" href="javascript:void(0)">Delete</a>

                    @elseif($content_type == "Q&A")
                    <a href="{{ url('admin/content-approval1/question-detail/' . $obj->id) }}" class="btn btn-secondary">View</a>
                            @if ($obj->status == '0')
                            <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="approveQuestion({{$obj->id}})"  href="javascript:void(0)">Approve</a>
                            <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="disapproveQuestion({{$obj->id}})" href="javascript:void(0)" >Disapprove</a>
                            @endif
                    <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="deleteQnA({{$obj->id}})" href="javascript:void(0)">Delete</a>

                    @elseif($content_type == "Comment")
                            {{-- <a href="{{ url('admin/content-approval/question-detail/' . $obj->id) }}" class="btn btn-secondary">View</a> --}}
                            @if ($obj->status == '0')
                            <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="approveComment({{$obj->id}})"  href="javascript:void(0)">Approve</a>
                            <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="disapproveComment({{$obj->id}})" href="javascript:void(0)" >Disapprove</a>
                            @endif
                                                        <a class="btn btn-secondary btn-post-{{$obj->id}}" onclick="deleteComment({{$obj->id}})" href="javascript:void(0)">Delete</a>

                    @endif



                </td>
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
