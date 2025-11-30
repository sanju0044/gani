@if(Auth::user()->paid_user==1 || Auth::user()->status==1)
    <div class="row user-comment-wrapper">
        <div class="user-comment-section col-md-1">

            @if (Auth::user()->profile_picture == null)
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="50" height="50">
            @else
            <img src="{{URL::to('/')}}/images/{{ Auth::user()->profile_picture }}" width="50" height="50">
            @endif
        </div>
        <div class="col-md-9 comment-text section">
            <input type="text" class="form-control" id="input-comment-{{$post_id}}"  aria-describedby="emailHelp" placeholder="Write a Comment.....">
        </div>
        <div class="col-md-2 comment-text section" style="margin-top: 5px;">
            <button class="btn btn-primary" onclick="submitComment({{$post_id}})" type="button">Send</button>
        </div>
    </div>
@endif
@foreach($comments as $comment)
<div class="row user-comment-wrapper">
    <div class="user-comment-section col-md-1">

        @if ($comment->commentedBy->profile_picture == null)
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="45" height="45">
        @else
        <img src="{{URL::to('/')}}/images/{{ $comment->commentedBy->profile_picture }}" width="45" height="45">
        @endif
    </div>
    <div class="col-md-10 comment-text section">
        <div>
            <span>
                <strong>{{ucwords($comment->commentedBy->first_name)}} {{ucwords($comment->commentedBy->last_name)}}</strong>
                <small>{{$comment->created_at}}</small>
            </span>
            <div>
                <span>{{$comment->comment}}</span>
            </div>
        </div>
    </div>
</div>
@endforeach

