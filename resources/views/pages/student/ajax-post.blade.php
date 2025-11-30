@if(count($posts))
@foreach ($posts as $data )


<div class="profile-content-section">
    <div class="row">
        <div class="profile-post-image-section col-md-2 col-3">
            @if ($data->mentor->profile_picture == null)
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                width="80" height="80" />
        @else
            <img src="{{URL::to('/')}}/images/{{ $data->mentor->profile_picture }}" width="80"
                height="80" />
        @endif
        </div>
        <div class="col-md-10 col-9 comment-text section">
            <a href="{{url('student/mentor/post/'.base64_encode($data->mentor->id))}}"> <h4>{{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}</h4></a>
            <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                <p>{{ getFollowersCount($data->mentor->id) }} Followers</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="post-content-section">
            <p>
                {{-- {{$data->description}} --}}
                {!! $data->description!!}
            </p>
        </div>
    </div>
    @if($data->photo)
        <div class="row">
            <img src="{{URL::to('/')}}/images/{{$data->photo}}"
            style="width:100%"   alt="post-image-preview" />
        </div>
    @endif
    @if($data->video && strlen($data->video)>7)
        @if($data->video != '?rel=0' && $data->video != '?rel=0?rel=0')
            <div class="row col-12">
                <iframe src="{{$data->video}}" height="400" width="100%" ></iframe>
            </div>         
        @endif
    @endif
    <div class="row like-comment-section">
        <div class="col-md-6 col-6">
            <a href="javascript:void(0)"><i class="fas fa-thumbs-up"></i><span id="like-counter-{{$data->id}}">{{getTotalPostLikes($data->id)}} {{getTotalPostLikes($data->id)>1?"Likes":"Like"}}</span></a>
        </div>
        <div class="col-md-6 col-6 text-right">
            <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{$data->id}})"><i class="fas fa-comment"></i><span id="comment-counter-{{$data->id}}">{{getTotalPostComments($data->id)}} Comments</span></a>
        </div>
    </div>
    @if(Auth::user()->paid_user==1)
        <div class="row commnents-writing-section">
            <div class="col-md-2 col-3">
                @if(isLiked($data->id, Auth::user()->id))
                <a href="javascript:void(0)" class="unlike" data-post-id="{{$data->id}}" onclick="likePost(this, {{$data->id}})"><i class="fas fa-thumbs-up"></i><span>Liked</span></a>
                @else
                <a href="javascript:void(0)" class="like" data-post-id="{{$data->id}}" onclick="likePost(this, {{$data->id}})"><i class="far fa-thumbs-up"></i><span>Like</span></a>
                @endif
            </div>
            <div class="col-md-6 text-left col-6">
                <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{$data->id}})"><i class="fas fa-comments"></i><span>Comments</span></a>
            </div>
        </div>
    @endif
    <div id="comment-containers-{{$data->id}}">

    </div>
</div>
            @endforeach

    @else
    <!-- <div class="profile-content-section">  <div class="row"><div class="col-md-12">No Content Available </div></div></div> -->

@endif