@if(count($posts)) @foreach ($posts as $data )

<!-- <form id="post_form" method="post" enctype="multipart/form-data" onsubmit="return false">
    <div class="row column-second-section">
        <div class="col-md-12">
            <strong>Add Post</strong>
        </div>
        <div class="col-md-12">
            <div class="post-content-section">
                <img src="https://i-goc.org/ibit/public/images/Image-Upload.png" style="width: 100%;" height="251px" id="post-image-preview" alt="post-image-preview" />
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <select name="language_id" id="language_id" class="form-control my-0 py-1 amber-border">
                            <option value="">Language</option>
                            @foreach($languages as $language)
                            <option value="{{$language->id}}">{{$language->language}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <select name="topic_id" id="topic_id" class="form-control my-0 py-1 amber-border">
                            <option value="">Topics</option>
                            @foreach($topics as $topic)
                            <option value="{{$topic->id}}">{{$topic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <select name="standard_id" id="standard_id" class="form-control my-0 py-1 amber-border">
                            <option value="">Standard</option>
                            @foreach($standards as $standard)
                            <option value="{{$standard->id}}">{{$standard->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <select name="category_id" id="category_id" class="form-control my-0 py-1 amber-border">
                            <option value="">Categories</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            Add Video URL:
            <i
                class="fa fa-info-circle"
                aria-hidden="true"
                data-placement="bottom"
                title="1. On a computer, go to the YouTube video or playlist you want to embed.
                            2. Click SHARE .
                            3. From the list of Share options, click Embed.
                            4. From the box that appears, copy the HTML code."
            ></i>
            <input type="text" id="url" name="post_video" class="form-control" placeholder="Add Video URL" />
        </div>

        <div class="col-md-12">
            <input type="text" id="description" name="description" class="form-control" placeholder="Add Description" />
        </div>

        <div class="row">
            <div class="col-md-5">
                <label>Upload a photo</label>
            </div>
            <div class="col-md-5">
                <input class="form-control" accept="image/*" required name="post_file" type="file" onchange="loadPostFile(event)" />
            </div>
            <div class="col-md-2" style="text-align: center;">
                <a href="javascript:void(0)" onclick="publishPost()" class="nav-link login-text" style="margin-top: 10px;">Publish</a>
            </div>
        </div>
    </div>
</form>

<div class="background-color-white d-md-block mentor_filters" style="margin-top:25px;padding-left:5px; padding-right:5px;">
    <div class="row">
        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="language_id" id="language_id_filter" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                    <option value="">Language</option>
                    @foreach($languages as $language)
                    <option @if($sel_language_id==$language->id) selected @endif value="{{$language->id}}">{{$language->language}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="topic_id" id="topic_id" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                    <option value="">Topics</option>
                @foreach($topics as $topic)
                    <option @if($sel_topic_id==$topic->id) selected @endif value="{{$topic->id}}">{{$topic->name}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="standard_id" id="standard_id" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                    <option value="">Standard</option>
                    @foreach($standards as $standard)
                    <option @if($sel_standard_id==$standard->id) selected @endif value="{{$standard->id}}">{{$standard->name}}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group md-form form-sm form-2 pl-0">
                <select name="category_id" id="category_id" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                    <option value="">Categories</option>
                    @foreach($categories as $category)
                    <option @if($sel_category_id==$category->id) selected @endif  value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
</div> -->
                    @foreach ($posts as $data )
                    
                    <div class="profile-content-section">
                        <div class="row">
                            <div class="profile-post-image-section col-md-2 col-3">
                                @if ($data->mentor->profile_picture == null)
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                    width="80" height="80" />
                            @else
                                <img src="{{URL::to('/')}}/images/{{ $data->mentor->profile_picture }}" width="80" height="80" />
                            @endif
                            </div>
                            <div class="col-md-10 col-9 section">
                                <a href="{{url('student/mentor/post/'.base64_encode($data->mentor->id))}}"> <h4>{{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}</h4></a>
                                <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                    <p>{{ getFollowersCount($data->mentor->id) }} Followers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="post-content-section">
                                <p>
                                    {{$data->description}}
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
                        <div class="row">
                           <iframe src="{{$data->video}}" height="400" width="100%" ></iframe>
                        </div>
                        @endif
                        <div class="row like-comment-section">
                            <div class="col-md-6 col-6">
                                <a href="javascript:void(0)"><i class="fas fa-thumbs-up"></i><span id="like-counter-{{$data->id}}">{{getTotalPostLikes($data->id)}} {{getTotalPostLikes($data->id)>1?"Likes":"Like"}}</span></a>
                            </div>
                            <div class="col-md-6 col-6 text-right">
                                <a href="javascript:void(0)"><i class="fas fa-comment"></i><span id="comment-counter-{{$data->id}}">{{getTotalPostComments($data->id)}} Comments</span></a>
                            </div>
                        </div>
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
                        <div id="comment-containers-{{$data->id}}">

                        </div>
                    </div>
                    @endforeach

                </div>

<div class="profile-content-section">
    <div class="row">
        <div class="profile-post-image-section col-md-2 col-3">
            @if ($data->mentor->profile_picture == null)
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="80" height="80" />
            @else
            <img src="{{URL::to('/')}}/images/{{ $data->mentor->profile_picture }}" width="80" height="80" />
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
                {{$data->description}}
            </p>
        </div>
    </div>
    @if($data->photo)
    <div class="row">
        <img src="{{URL::to('/')}}/images/{{$data->photo}}" style="width: 100%;" alt="post-image-preview" />
    </div>
    @endif @if($data->video && strlen($data->video)>7)
    <div class="row col-12">
        <iframe src="{{$data->video}}" height="400" width="100%"></iframe>
    </div>
    @endif
    <div class="row like-comment-section">
        <div class="col-md-6 col-6">
            <a href="javascript:void(0)"><i class="fas fa-thumbs-up"></i><span id="like-counter-{{$data->id}}">{{getTotalPostLikes($data->id)}} {{getTotalPostLikes($data->id)>1?"Likes":"Like"}}</span></a>
        </div>
        <div class="col-md-6 col-6 text-right">
            <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{$data->id}})"><i class="fas fa-comment"></i><span id="comment-counter-{{$data->id}}">{{getTotalPostComments($data->id)}} Comments</span></a>
        </div>
    </div>
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
    <div id="comment-containers-{{$data->id}}"></div>
</div>
@endforeach @else
<div class="profile-content-section">
    <div class="row"><div class="col-md-12">No Content Available</div></div>
</div>

@endif

<script>
    function publishPost(){
            var description = $("#description").val()
            if(description=="")
            {
                alert("Please enter description.")
                return;
            }
            var formData = $('#post_form')[0];


          var data = new FormData(formData);

            $.ajax({
                url: "{{ url('mentor/publish-post') }}",
                type:'post',
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                data:data,
                success: function(result) {
                    $("#description").val("");
                    $("#post_file").val("");
                    $("#post-image-preview").attr("src", "data:image/png;base64,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")
                    swal("Success", result.message, "success");
                }
            });

        }
</script>

