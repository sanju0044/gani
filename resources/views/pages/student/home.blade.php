@extends('layouts.app')

@section('content')
<style>
    .third-section-wrapper1{
        display: none;
    }
    .profile-content-section{
        margin-bottom: 30px;
    }
    .advertise-wrapper {
        margin-top: 20px;
    }
    @media only screen and (min-width: 321px) and (max-width: 767px)
    {
        .hide-image-mobile
        {
            display: none;
        }
        .profile-wrapper {
            /* background: #e8f4f9; */
            display: none;
        }
        .advertise-wrapper img{
            /* margin-left: -25px !important; */
            margin-left: 0px !important;
            width: 100%;
            margin-bottom: 18px;
        }
        .card{
            padding-left: 8px !important;
            padding-right: 8px;
            padding: 5px;
        }
        .second-section-wrapper{
            padding-top: 0px;
        }
        .profile-content-section{
            margin-top: 0px;
        }
        .comment-text.section {
            padding: 6px 10px;
        }
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-xs-2 col-sm-2 col-lg-3">
            <div class="profile-wrapper">
                <div class="profile-image-wrapper hide-image-mobile text-center">
                    @if (Auth::user()->profile_picture == null)
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="100" height="100">
                    @else
                    <img src="{{URL::to('/')}}/images/{{ Auth::user()->profile_picture }}" width="100" height="100">

                    @endif
                   
                </div>
                <div class="text-center d-none d-md-block">
                    <div><h3>{{ucfirst(Auth::user()->first_name)}} {{ucfirst(Auth::user()->last_name)}}</h3></div>
                    <div><p>{{isset(Auth::user()->cityModel)? ucfirst(Auth::user()->cityModel->city_name):""}}</p></div>
                    <div><p>{{ucfirst(Auth::user()->standard)}} Standard</p></div>
                    <a href="{{url("student/profile")}}" class="btn btn-primary" style="color: #00a2cb !important;background: #ffff !important;"><i class="fas fa-user-tie" style="color: #00a2cb !important;border-radius:4px;"></i>Profile</a>
                      
                </div>
                <div class="row text-center profile-image-div-third">

                </div>
            </div>
            {{--  Advertise start --}}
            @foreach($data as $key=>$obj)
            <div class="advertise-wrapper hidden-xs"> 
                <div class="" >
                    <img src="{{ URL::to('/') }}/images/{{ $obj->profile_picture }}" width="276" height="250">
                </div><br>
              {{--  <div class="" >
                    <img src="{{ URL::to('/') }}/images/{{ $obj->profile_picture1 }}" width="276" height="250">
                </div> --}}
            </div>
            @endforeach
        </div>

       

  {{--  Advertise end --}}
        

        <div  class="col-md-9 second-section-wrapper">
            <div class=" background-color-white  d-md-block" style="padding-left:5px; padding-right:5px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <select name="language_id" id="language_id" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                                <option value="">Language</option>
                                @foreach($languages as $language)
                                <option value="{{$language->id}}">{{$language->language}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <select name="topic_id" id="topic_id" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                                <option value="">Topics</option>
                                @foreach($topics as $topic)
                                <option value="{{$topic->id}}">{{$topic->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <select name="standard_id" id="standard_id" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                                <option value="">Standard</option>
                                @foreach($standards as $standard)
                                <option value="{{$standard->id}}">{{$standard->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <select name="category_id" id="category_id" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                                <option value="">Categories</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            </div>

            {{-- <input type="text" id="path" /> --}}

            <div id="div-to-update">
            @if(count($posts)== 0)
            <div class="profile-content-section">
                <div class="row">
                    <div class="profile-post-image-section col-md-12">
                        <h3>No Post Found.</h3>
                    </div>
                    </div>
                    </div>
            @endif
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
                    <div class="row col-12">
                        <iframe src="{{$data->video}}" height="400" width="100%" ></iframe>
                    </div>
                @endif
                <div class="row like-comment-section">
                    <div class="col-md-6 col-6">
                        <a href="javascript:void(0)"><i class="fas fa-thumbs-up"></i><span id="like-counter-{{$data->id}}">{{getTotalPostLikes($data->id)}} {{getTotalPostLikes($data->id)>1?"Likes":"Like"}}</span></a>
                    </div>
                    @if( Auth::user()->view_status==1 )
                    <div class="col-md-6 col-6 text-right">
                        <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{$data->id}})"><i class="fas fa-comment"></i><span id="comment-counter-{{$data->id}}">{{getTotalPostComments($data->id)}} Comments</span></a>
                    </div>
                    @endif
                </div>
                @if( Auth::user()->status==1)
                    <div class="row commnents-writing-section">
                        <div class="col-md-2 col-3">
                            @if(isLiked($data->id, Auth::user()->id))
                            <a href="javascript:void(0)" class="unlike" data-post-id="{{$data->id}}" onclick="likePost(this, {{$data->id}})"><i class="fas fa-thumbs-up"></i><span>Liked</span></a>
                            @else
                            <a href="javascript:void(0)" class="like" data-post-id="{{$data->id}}" onclick="likePost(this, {{$data->id}})"><i class="far fa-thumbs-up"></i><span>Like</span></a>
                            @endif
                        </div>
                        @if(Auth::user()->view_status==1)
                        <div class="col-md-6 text-left col-6">
                            <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{$data->id}})"><i class="fas fa-comments"></i><span>Comments</span></a>
                        </div>
                        @endif
                    </div>
                @endif
                <div id="comment-containers-{{$data->id}}">

                </div>
            </div>
            @endforeach
            </div>

        </div>
        
    </div>
</div>
@endsection

@section('js_script')
<script>
    var loading = true;//to prevent duplicate
    var page = 2;

function loadNewContent(){
    var language_id = $("#language_id").val();
 var topic_id = $("#topic_id").val();
 var standard_id = $("#standard_id").val();
 var category_id = $("#category_id").val();
  loading = false;
    $.ajax({
        type:'POST',
        url: '{{url("student/ajax-load-more-post")}}',
        data:{ page: page,
            language_id:language_id,
            topic_id:topic_id,
            standard_id:standard_id,
            category_id:category_id,
        },
        success:function(data){
            if(data != ""){

                $("#div-to-update").append(data);
                page++
                 loading = true;
            }else{
                loading = false;
            }
        }
    });
}

function filterPost(){

 page = 1;
 var language_id = $("#language_id").val();
 var topic_id = $("#topic_id").val();
 var standard_id = $("#standard_id").val();
 var category_id = $("#category_id").val();
    $.ajax({
        type:'POST',
        url: '{{url("student/ajax-load-more-post")}}',
        data:{ page: page,
            language_id:language_id,
            topic_id:topic_id,
            standard_id:standard_id,
            category_id:category_id,
        },
        success:function(data){
                $("#div-to-update").html(data);
                page = 2;
                loading = true;

        }
    });
}

//scroll DIV's Bottom
$(window).scroll(function() {
     console.log($(window).scrollTop() + " " + $(document).height() +"  "+ $(window).height())
    if($(window).scrollTop() > $(document).height() - $(window).height()-100) {

        if(loading)
        {
        loadNewContent()
        }
    }
});

function likePost(ele, post_id)
{
    if($(ele).hasClass('like'))
    {
    var str = '<i class="fas fa-thumbs-up"></i><span>Liked</span>';
    $(ele).html(str)
    $(ele).removeClass("like")
    $(ele).addClass("unlike")
    var count = parseInt($("#like-counter-"+post_id).text());
    count++;
    var like_string = " Like";
    if(count>1)
    {
        like_string = " Likes";
    }
    $("#like-counter-"+post_id).text(count+like_string);
    ajaxLikePost(post_id, "like");
    }else{
    var str = '<i class="far fa-thumbs-up"></i><span>Like</span>';
    $(ele).html(str)
    $(ele).removeClass("unlike")
    $(ele).addClass("like")
    var count = parseInt($("#like-counter-"+post_id).text());
    count--;

    var like_string = " Like";
    if(count>1)
    {
        like_string = " Likes";
    }
    $("#like-counter-"+post_id).text(count+like_string);
    ajaxLikePost(post_id, "unlike");
    }
}

function ajaxLikePost(post_id, type)
{
    $.ajax({
        type:'POST',
        url: '{{url("student/ajax-like-post")}}',
        data:{ post_id: post_id,
        type:type
        },
        success:function(data){

        }
    });
}

function ajaxLoadComment(ele, post_id)
{
    $.ajax({
        type:'POST',
        url: '{{url("student/ajax-load-post-comments")}}',
        data:{ post_id: post_id},
        success:function(html){
            $("#comment-containers-"+post_id).html(html);
        }
    });
}

function submitComment( post_id)
{
    if($.trim($("#input-comment-"+post_id).val()) =="")
    {
        alert("Please write comment.");
        return;
    }
    $.ajax({
        type:'POST',
        url: '{{url("student/ajax-submit-comment")}}',
        data:{
            post_id: post_id,
            comment: $.trim($("#input-comment-"+post_id).val()),

        },
        success:function(html){
            $("#input-comment-"+post_id).val("");
            swal("Success", "Comment submitted successfully! Comment is under approval.", "success");

        }
    });
}

    </script>

    @endsection

