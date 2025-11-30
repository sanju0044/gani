@extends('layouts.app') 

@section('content')
<style>
    .small-box > .small-box-footer {
        background: none;
        color: black;
        text-decoration: underline;
    }
    .profile-name-section-1 h3 {
        color: #000;
    }
    .profile-name-section-1 p {
        color: #00000085;
        margin-top: -9px;
    }
    .show-profile-wrapper {
        background: #00a2cb;
        color: #ffff;
        padding: 13px;
        margin-bottom: 25px;
    }
    .comment-text{
        /* margin-left: 27px; */
        margin-top: 10px;
    }
    @media only screen and (min-width: 321px) and (max-width: 767px){
        .comment-text{
            margin-top: 5px;
        }
    }
   .tabs-full .nav-link {
    background: #f5f5f5;
    border-radius: 8px;
    margin: 4px;
    padding: 12px 10px;
    font-weight: 600;
    color: #333;
    transition: 0.3s ease-in-out;
}

.tabs-full .nav-link:hover {
    background: #e0e0e0;
}

.tabs-full .nav-link.active {
    background: #3498db;
    color: #fff !important;
    box-shadow: 0px 3px 6px rgba(0,0,0,0.2);
}
@media (max-width: 576px) {
    .tabs-full .nav-link {
        font-size: 14px;
        padding: 10px;
    }
}
 .ck-editor__editable {
        min-height: 300px;
    }
    .post-card {
    border: 1px solid #e5e5e5;
    background: #fff;
    transition: 0.2s;
}
.post-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.10);
}
.post-content p {
    font-size: 15px;
    color: #333;
}
.like-section a, .action-buttons a {
    color: #555;
    font-size: 14px;
}
.like-section a:hover, .action-buttons a:hover {
    color: #000;
}
</style>
     
<div class="container pd-20 card-box mb-30" style="padding-top: 25px;">
    <div class="row post-profile-wrapper">
        <div class="col-md-10 col-12">
            <div class="profile-image-section">
                <div>
                    @if (Auth::user()->profile_picture == null)
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="80" height="80" />
                    @else
                    <img src="{{URL::to('/')}}/images/{{ Auth::user()->profile_picture }}" width="80" height="80" />
                    @endif
                </div>
                <div class="profile-name-section-1">
                    <h3> {{ucfirst(Auth::user()->first_name)}} {{ucfirst(Auth::user()->last_name)}}</h3>
                    <br>
                    <p><strong>{{Auth::user()->short_bio}}, {{ isset(Auth::user()->cityModel)?ucfirst(Auth::user()->cityModel->city_name):"" }}.</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>          
        {{-- <div class="col-md-2 col-12 profile-button-wrapper" >
            <a href="{{url('mentor/profile')}}" class="nav-link login-text"><i class="fas fa-user-circle profile-icon"></i>Edit Profile</a>
        </div> --}}
<div class="container pd-20 card-box mb-30" style="padding-top: 25px;">
    <div class="row">
        <ul class="nav nav-pills w-100 tabs-full justify-content-between">
            <li class="nav-item flex-fill text-center">
                <a class="nav-link active" data-toggle="tab" href="#home">Post</a>
            </li>
            <li class="nav-item flex-fill text-center">
                <a class="nav-link" data-toggle="tab" href="#menu1">Photos</a>
            </li>
            <li class="nav-item flex-fill text-center">
                <a class="nav-link" data-toggle="tab" href="#menu2">Followers</a>
            </li>
            <li class="nav-item flex-fill text-center">
                <a class="nav-link" data-toggle="tab" href="#menu3" onclick="getPendingQuestions()">Q&A</a>
            </li>
            <li class="nav-item flex-fill text-center">
                <a class="nav-link" data-toggle="tab" href="#menu4">Approval Status</a>
            </li>
        </ul>
    </div>
</div>
<div class="container pd-20 card-box mb-30" style="padding-top: 25px;">
    <div class="row">
        <div class="coloumn-first-post">
            <div class="row heading-text">
                <div class="col-md-6 col-6">
                    Photos
                </div>
                <div class="col-md-6 col-6 text-right">
                    <a href="#"><u>View All Photos</u></a>
                </div>
            </div>
            <div class="row">
                @foreach($photos as $photo)
                <div class="col-md-6">
                    <img src="{{URL::to('/')}}/images/{{$photo->photo}}" style="width: 100%; border: 1px solid #e6e6e6;" />
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="col-md-12 followers-section">
                <div class="col-md-6">
                    <h6>Followers</h6>
                    <p style="font-size: 12px;">{{ getFollowersCount(Auth::user()->id) }} people following</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container pd-20 card-box mb-30" style="padding-top: 25px;">
    <div class="tab-content">
         <div id="home" class="tab-pane fade show active">
            <div class="row section-first-post">
                <div class="col-md-12" id="div-to-update-oooollllddd">
                    <form id="post_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <div class="row column-second-section">
                            <div class="col-md-12">
                                 <strong>Add Post</strong>
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="post-content-section">
                                     <img src="https://i-goc.org/ibit/public/images/Image-Upload.png" style="width:100%"
                                         height="251px" id="post-image-preview" alt="post-image-preview" />
                                 </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group md-form form-sm form-2 pl-0">
                                            <select name="language_id" id="language_id"
                                                 class="form-control my-0 py-1 amber-border">
                                                <option value="">Language</option>
                                                 @foreach ($languages as $language)
                                                     <option value="{{ $language->id }}">{{ $language->language }}
                                                     </option>
                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group md-form form-sm form-2 pl-0">
                                            <select name="topic_id" id="topic_id"
                                                 class="form-control my-0 py-1 amber-border">
                                                <option value="">Topics</option>
                                                 @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->name }} </option>
                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group md-form form-sm form-2 pl-0">
                                            <select name="standard_id" id="standard_id"
                                                 class="form-control my-0 py-1 amber-border">
                                                <option value="">Standard</option>
                                                 @foreach ($standards as $standard)
                                                    <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                 @endforeach
                                            </select>
                                         </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group md-form form-sm form-2 pl-0">
                                            <select name="category_id" id="category_id"
                                                 class="form-control my-0 py-1 amber-border">
                                                <option value="">Categories</option>
                                                 @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                 </div>
                             </div>

                            <div class="col-md-12">
                                 <label> Add Video URL:</label> <i class="fa fa-info-circle" aria-hidden="true"
                                     data-placement="bottom"
                                     title="1. On a computer, go to the YouTube video or playlist you want to embed.
                            2. Click SHARE .
                            3. From the list of Share options, click Embed.
                            4. From the box that appears, copy the HTML code."></i>
                                 <input type="text" id="url" name="post_video" class="form-control"
                                     placeholder="Add Video URL" />
                            </div>
                            <div class="col-md-12 mt-4">
                                 <label>Add Description : </label>
                                 <textarea class="summernote richTextarea" id="description" name="description"></textarea>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label>Upload a photo</label>
                                <input class="form-control" accept="image/*" name="post_file" id="post_file" type="file" onchange="loadPostFile(event)" />
                                <div class="col-md-2" style="text-align: center; margin-top:-1px;">
                                     <button class="nav-link login-text btn btn-primary" id="publish1"
                                         style="margin-top: 10px;">Publish</button>
                                </div>
                            </div>
                        </div>
                    </form>
                     @if (count($posts) == 0)
                         <div class="profile-content-section">
                             <div class="row">
                                 <div class="profile-post-image-section col-md-12">
                                     <h3>No Post Found.</h3>
                                 </div>
                             </div>
                         </div>
                     @endif
                     <div class="background-color-white d-md-block mentor_filters"
                         style="margin-top:25px;padding-left:5px; padding-right:5px;">
                         <div class="row">
                             <div class="col-md-3">
                                 <div class="input-group md-form form-sm form-2 pl-0">
                                     <select name="language_id" id="language_id_filter"
                                         class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                                         <option value="">Language</option>
                                         @foreach ($languages as $language)
                                             <option value="{{ $language->id }}">{{ $language->language }} </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <div class="input-group md-form form-sm form-2 pl-0">
                                     <select name="topic_id" id="topic_id" class="form-control my-0 py-1 amber-border"
                                         onchange="filterPost()">
                                         <option value="">Topics</option>
                                         @foreach ($topics as $topic)
                                             <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <div class="input-group md-form form-sm form-2 pl-0">
                                     <select name="standard_id" id="standard_id"
                                         class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                                         <option value="">Standard</option>
                                         @foreach ($standards as $standard)
                                             <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="col-md-3">
                                 <div class="input-group md-form form-sm form-2 pl-0">
                                     <select name="category_id" id="category_id"
                                         class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                                         <option value="">Categories</option>
                                         @foreach ($categories as $category)
                                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                         </div>
                     </div>
                    <div id="div-to-update">
                        @foreach ($posts as $data)
                            <div class="card shadow-sm mb-4 p-3 rounded post-card">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="mr-3">
                                        @if ($data->mentor->profile_picture == null)
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                                class="rounded-circle" width="70" height="70" />
                                        @else
                                            <img src="{{ URL::to('/') }}/images/{{ $data->mentor->profile_picture }}"
                                                class="rounded-circle" width="70" height="70" />
                                        @endif
                                    </div>

                                    <div class="w-100">
                                        <a href="{{ url('student/mentor/post/' . base64_encode($data->mentor->id)) }}">
                                            <h5 class="m-0 font-weight-bold">
                                                {{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}
                                            </h5>
                                        </a>
                                        <small class="text-muted">{{ getFollowersCount($data->mentor->id) }} Followers</small>
                                        <hr class="mt-2 mb-1">
                                    </div>
                                </div>

                                <div class="post-content mb-3">
                                    {!! $data->description !!}
                                </div>

                                @if ($data->photo)
                                    <div class="mb-3">
                                        <img src="{{ URL::to('/') }}/images/{{ $data->photo }}" class="img-fluid rounded w-100" />
                                    </div>
                                @endif

                                @if ($data->video && strlen($data->video) > 7)
                                    <div class="mb-3">
                                        <iframe src="{{ $data->video }}" height="400" width="100%" class="rounded"></iframe>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between border-top pt-2 pb-2 text-muted like-section">
                                    <a href="javascript:void(0)"><i class="fas fa-thumbs-up"></i>
                                        <span id="like-counter-{{ $data->id }}">{{ getTotalPostLikes($data->id) }}
                                            {{ getTotalPostLikes($data->id) > 1 ? 'Likes' : 'Like' }}
                                        </span>
                                    </a>

                                    <a href="javascript:void(0)"><i class="fas fa-comment"></i>
                                        <span id="comment-counter-{{ $data->id }}">{{ getTotalPostComments($data->id) }} Comments</span>
                                    </a>
                                </div>

                                <div class="d-flex justify-content-between action-buttons mt-2">
                                    <div>
                                        @if (isLiked($data->id, Auth::user()->id))
                                            <a href="javascript:void(0)" class="unlike" data-post-id="{{ $data->id }}"
                                            onclick="likePost(this, {{ $data->id }})">
                                                <i class="fas fa-thumbs-up"></i><span> Liked</span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="like" data-post-id="{{ $data->id }}"
                                            onclick="likePost(this, {{ $data->id }})">
                                                <i class="far fa-thumbs-up"></i><span> Like</span>
                                            </a>
                                        @endif
                                    </div>

                                    <div>
                                        <a href="javascript:void(0)" onclick="ajaxLoadComment(this, {{ $data->id }})">
                                            <i class="fas fa-comments"></i><span> Comments</span>
                                        </a>
                                    </div>
                                </div>

                                <div id="comment-containers-{{ $data->id }}" class="mt-3"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
         </div>
         <div id="menu1" class="tab-pane fade">
             <div class="container">
                 <div class="row">
                     <div class="col-md-4">
                         <form action="{{ url('mentor/upload-photo') }}" enctype="multipart/form-data"
                             method="post">
                             <div class="coloumn-first-post">
                                 <div class="row heading-text">
                                     <div class="col-md-6">
                                         <strong>Add Photos</strong>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <img src="data:image/png;base64,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"
                                         style="width:100%" height="251px" id="profile-image-preview"
                                         alt="profile-image" />
                                 </div>
                                 <div class="row" style="margin-top: 14px;">
                                     <div class="col-md-12">
                                         {{-- <button type="file" class="btn btn-default" style="width: 100%;"><i class="fas fa-upload"></i>Upload a photo</button> --}}
                                         <input class="form-control form-control-lg" accept="image/*" required
                                             name="photo" type="file" onchange="loadFile(event)" />
                                     </div>
                                 </div>
                                 <div class="row" style="margin-top: 14px;">
                                     <div class="col-md-12">
                                         <input type="text" id="photo_description" required
                                             name="photo_description" class="form-control"
                                             placeholder="Add Description" />
                                     </div>
                                 </div>
                                 <div class="row" style="margin-top: 14px;">
                                     <div class="col-md-12 text-right">
                                         <button type="submit" class="btn btn-primary">Upload</button>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                     <div class="col-md-8">
                         <div class="row d-flex flex-wrcoap align-items-center gallery-images-wrapper"
                             data-toggle="modal" data-target="#lightbox">
                             @if (count($photos) == 0)
                                 <h3>No Photo Found.</h3>
                             @endif
                             @foreach ($photos as $photo)
                                 <div class="col-12 col-md-6 col-lg-3 gallery-image-second-wrapper mentorpic">
                                     <a href="{{ URL::to('/') }}/images/{{ $photo->photo }}" target="_blank">
                                         <img src="{{ URL::to('/') }}/images/{{ $photo->photo }}" alt="" />
                                     </a>
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 </div>

                 <!-- Modal -->
                 <div class="modal fade" id="lightbox1" role="dialog" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <button type="button" class="close text-right p-2" data-dismiss="modal"
                                 aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                             <div id="indicators" class="carousel slide" data-interval="false">
                                 {{-- <ol class="carousel-indicators">
                                    <li data-target="#indicators" data-slide-to="0" class="active"></li>
                                </ol> --}}
                                 <div class="carousel-inner">

                                     @foreach ($photos as $photo)
                                         <div class="carousel-item active">
                                             <img class="d-block w-100"
                                                 src="{{ URL::to('/') }}/images/{{ $photo->photo }}"
                                                 alt="First slide" />
                                         </div>
                                     @endforeach

                                 </div>
                                 <a class="carousel-control-prev" href="#indicators" role="button"
                                     data-slide="prev">
                                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                     <span class="sr-only">Previous</span>
                                 </a>
                                 <a class="carousel-control-next" href="#indicators" role="button"
                                     data-slide="next">
                                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                     <span class="sr-only">Next</span>
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div id="menu2" class="tab-pane fade">
             <div class="row row-spacing p-3">

                 @if (count($followers) == 0)
                     <h3>No Follower Found.</h3>
                 @endif
                 @foreach ($followers as $follower)
                     <div class="col-md-4 col-6">
                         <div class="row">
                             <div class="col-md-6">
                                 @if ($follower->student->profile_picture == null)
                                     <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                                         width="160" height="150" style="border: 1px solid #00000038;" />
                                 @else
                                     <img src="{{ URL::to('/') }}/images/{{ $follower->student->profile_picture }}"
                                         width="160" height="150" style="border: 1px solid #00000038;" />
                                     {{-- <img src="{{ url('storage/images/'.$follower->student->profile_picture) }}" alt="" title="" /> --}}
                                 @endif
                             </div>
                             <div class="col-md-6">
                                 <strong>{{ ucwords($follower->student->first_name) }}
                                     {{ ucwords($follower->student->last_name) }}</strong>
                                 <p> {{ isset($follower->cityModel) ? ucfirst($follower->cityModel->city_name) : '' }}</p>
                             </div>
                         </div>
                     </div>
                 @endforeach

             </div>
         </div>
         <div id="menu3" class="tab-pane fade">
             <div class="container pd-20 card-box mb-30" style="padding-top: 25px;">
                <div class="row">
                    <ul class="nav nav-pills w-100 tabs-full justify-content-between">
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link active" data-toggle="tab" href="#menu102"
                                 onclick="getPendingQuestions()">Pending</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link" data-toggle="tab"  href="#menu101" onclick="getAnsweredQuestions()">Answered</a>
                        </li>
                    </ul>
                </div>
            </div>
             <div class="row feedback-wrapper">
                 <div id="menu5" class="tab-pane fade active show menu-full-width">
                     <div class="row" id="question-container">

                     </div>
                 </div>
             </div>
         </div>
         <div id="menu4" class="tab-pane fade">
            <div class="container pd-20 card-box mb-30" style="padding-top: 25px;">
                <div class="row">
                    <ul class="nav nav-pills w-100 tabs-full justify-content-between">
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link active" data-toggle="tab" href="#menu201">All</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link" data-toggle="tab" href="#menu202">Pending</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link" data-toggle="tab" href="#menu203">Approved</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link" data-toggle="tab" href="#menu204">Disapproved&A</a>
                        </li>
                    </ul>
                </div>
            </div>
             <div class="row feedback-wrapper">
                 <div class="tab-content">
                     <div id="menu201" class="tab-pane fade active show">
                         <div class="row approved-status-wrapper col-12">
                            <table id="example" class="table table-striped table-bordered mobile-l" style="width:100%">
                                <thead>
                                     <tr>
                                         <th>ID</th>
                                         <th>Content</th>
                                         <th>Date</th>
                                         <th>Type</th>
                                         <th>Status</th>
                                         <th>Remark</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($all_contents as $index => $content)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            @if ($content->content_type == 'post')
                                                <td> {!! $content->description !!}</td>
                                            @elseif($content->content_type == 'question')
                                                <td>{{ $content->question }}</td>
                                            @else
                                                <td>{{ $content->comment }}</td>
                                            @endif

                                            <td>{{ $content->created_at }}</td>
                                            @if ($content->content_type == 'post')
                                                <td>Post</td>
                                            @elseif($content->content_type == 'question')
                                                <td>Q&A</td>
                                            @else
                                                <td>Comment</td>
                                            @endif
                                            <td>
                                                @if ($content->status == '0')
                                                    <button style="cursor:default" type="button"
                                                        class="btn btn-warning">Pending</button>
                                                @elseif($content->status == '1')
                                                    <button style="cursor:default" type="button"
                                                        class="btn btn-success">Approved</button>
                                                @else
                                                    <button style="cursor:default" type="button"
                                                        class="btn btn-danger">Disapproved</button>
                                                @endif

                                            </td>
                                            <td>{{ $content->remark }}</td>
                                        </tr>
                                    @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                     <div id="menu202" class="tab-pane fade">
                         <div class="row approved-status-wrapper col-12">
                             <table id="example" class="table table-striped table-bordered nowrap"
                                 style="width:100%">
                                 <thead>
                                     <tr>
                                         <th>ID</th>
                                         <th>Content</th>
                                         <th>Date</th>
                                         <th>Type</th>
                                         <th>Status</th>
                                         <th>Remark</th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                     @foreach ($pending_contents as $index => $content)
                                         <tr>
                                             <td>{{ $index + 1 }}</td>
                                             @if ($content->content_type == 'post')
                                                 <td> {!! $content->description !!}</td>
                                             @elseif($content->content_type == 'question')
                                                 <td>{{ $content->question }}</td>
                                             @else
                                                 <td>{{ $content->comment }}</td>
                                             @endif

                                             <td>{{ $content->created_at }}</td>
                                             @if ($content->content_type == 'post')
                                                 <td>Post</td>
                                             @elseif($content->content_type == 'question')
                                                 <td>Q&A</td>
                                             @else
                                                 <td>Comment</td>
                                             @endif
                                             <td>
                                                 @if ($content->status == '0')
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-warning">Pending</button>
                                                 @elseif($content->status == '1')
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-success">Approved</button>
                                                 @else
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-danger">Disapproved</button>
                                                 @endif

                                             </td>
                                             <td>{{ $content->remark }}</td>
                                         </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>
                     </div>
                     <div id="menu203" class="tab-pane fade">
                         <div class="row approved-status-wrapper col-12">
                             <table id="example" class="table table-striped table-bordered nowrap"
                                 style="width:100%">
                                 <thead>
                                     <tr>
                                         <th>ID</th>
                                         <th>Content</th>
                                         <th>Date</th>
                                         <th>Type</th>
                                         <th>Status</th>
                                         <th>Remark</th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                     @foreach ($approved_contents as $index => $content)
                                         <tr>
                                             <td>{{ $index + 1 }}</td>
                                             @if ($content->content_type == 'post')
                                                 <td> {!! $content->description !!}</td>
                                             @elseif($content->content_type == 'question')
                                                 <td>{{ $content->question }}</td>
                                             @else
                                                 <td>{{ $content->comment }}</td>
                                             @endif

                                             <td>{{ $content->created_at }}</td>
                                             @if ($content->content_type == 'post')
                                                 <td>Post</td>
                                             @elseif($content->content_type == 'question')
                                                 <td>Q&A</td>
                                             @else
                                                 <td>Comment</td>
                                             @endif
                                             <td>
                                                 @if ($content->status == '0')
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-warning">Pending</button>
                                                 @elseif($content->status == '1')
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-success">Approved</button>
                                                 @else
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-danger">Disapproved</button>
                                                 @endif

                                             </td>
                                             <td>{{ $content->remark }}</td>
                                         </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>
                     </div>
                     <div id="menu204" class="tab-pane fade">
                         <div class="row approved-status-wrapper col-12">
                             <table id="example" class="table table-striped table-bordered nowrap"
                                 style="width:100%">
                                 <thead>
                                     <tr>
                                         <th>ID</th>
                                         <th>Content</th>
                                         <th>Date</th>
                                         <th>Type</th>
                                         <th>Status</th>
                                         <th>Remark</th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                     @foreach ($disapproved_contents as $index => $content)
                                         <tr>
                                             <td>{{ $index + 1 }}</td>
                                             @if ($content->content_type == 'post')
                                                 <td> {!! $content->description !!}</td>
                                             @elseif($content->content_type == 'question')
                                                 <td>{{ $content->question }}</td>
                                             @else
                                                 <td>{{ $content->comment }}</td>
                                             @endif

                                             <td>{{ $content->created_at }}</td>
                                             @if ($content->content_type == 'post')
                                                 <td>Post</td>
                                             @elseif($content->content_type == 'question')
                                                 <td>Q&A</td>
                                             @else
                                                 <td>Comment</td>
                                             @endif
                                             <td>
                                                 @if ($content->status == '0')
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-warning">Pending</button>
                                                 @elseif($content->status == '1')
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-success">Approved</button>
                                                 @else
                                                     <button style="cursor:default" type="button"
                                                         class="btn btn-danger">Disapproved</button>
                                                 @endif

                                             </td>
                                             <td>{{ $content->remark }}</td>
                                         </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>


             </div>

         </div>
         <div id="menu6" class="tab-pane fade">
             <div class="row feedback-wrapper">
                 <div class="col-md-12">
                     <ul class="nav nav-tabs">
                         <li class="active"><a data-toggle="tab" href="#menu5">Pending</a></li>
                         <li><a data-toggle="tab" href="#menu6">Answered</a></li>
                     </ul>
                 </div>
                 <div class="col-md-6">
                     <div class="profile-content-section feedback-form-wrapper">
                         <div class="question-ans-section">
                             <div class="row">
                                 <div class="profile-post-image-section col-md-1">
                                     <img src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" width="100"
                                         height="100">
                                 </div>
                                 <div class="col-md-11 comment-text section">
                                     <h4>Dr. Raghunath Mashelkar</h4>
                                     <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                         <p>3000 Followers</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="post-content-section">
                                     <p>
                                         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus
                                         dictum rutrum in eget nisl.
                                     </p>
                                 </div>
                             </div>
                             <div class="col-md-12 text-right" style="margin-top:20px;">
                                 <button type="" class="btn btn-primary">Edit</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="profile-content-section feedback-form-wrapper">
                         <div class="question-ans-section">
                             <div class="row">
                                 <div class="profile-post-image-section col-md-">
                                     <img src="{{ asset('public/images/25boss4r210_fjpalm_1.png') }}" width="80"
                                         height="80">
                                 </div>
                                 <div class="col-md-10 section">
                                     <h4>Dr. Raghunath Mashelkar</h4>
                                     <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                                         <p>3000 Followers</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="post-content-section">
                                     <p>
                                         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus
                                         dictum rutrum in eget nisl.
                                     </p>
                                 </div>
                             </div>
                             <div class="col-md-12 text-right" style="margin-top:20px;">
                                 <button type="" class="btn btn-primary">Edit</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
    </div>
</div>
<br><br><br>
@endsection
@push('scripts')

    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error(error);
                height: 300   // you can increase height here
            });
    </script>

    <script>
         var loading = true;//to prevent duplicate
        var page = 2;
        @if (Session::has('message'))
            swal("success", "{{ Session::get('message') }}", "success");
            @php
                Session::forget('message');
            @endphp
        @endif

        function setStatus(val) {
            $("#hidden-status").val(val);
            searchMentors();
        }



        function searchMentors() {
            $.ajax({
                url: "{{ url('admin/ajax-student-data') }}",
                data: {
                    name: $("#search_name").val(),
                    email: $("#search_email").val(),
                    status: $("#hidden-status").val(),
                    standard: $("#search_standard").val(),
                    age: $("#search_age").val(),
                },
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        }

        // function publishPost(){
           

        // }
        
        $(document).ready(function () {
        $("#publish1").click(function () {
            
             var description = $("#description").val()
             var post_file = $("#post_file").val()
       
            if(description=="")
            {
                alert("Please enter description.")
                return;
            }
            var formData = $('#post_form')[0];
          

          var data = new FormData(formData);
          $(".login-text").text('Loading..');
         
            $.ajax({
                url: "{{ url('mentor/publish-post') }}",
                type:'post',
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                data:data,
              
                success: function(result) {
                    
                    $(".login-text").text('Publish');
                     $(".login-text").attr("disabled", true);
                    $("#description").val("");
                    $("#post_file").val("");
                    $("#post-image-preview").attr("src", "data:image/png;base64,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")
                    swal("Success", result.message, "success");
                }
            });
        });
    });
   

        function getPendingQuestions()
        {
            $.ajax({
                url: "{{ url('mentor/get-pending-questions') }}",
                type:'post',
                success: function(result) {
                    $("#question-container").html(result)
                }
            });
        }

        function getAnsweredQuestions()
        {
            $.ajax({
                url: "{{ url('mentor/get-answered-questions') }}",
                type:'post',
                success: function(result) {
                    $("#question-container").html(result)
                }
            });
        }

        function submitAnswer(btn, ele_id)
        {


            // var ele = document.getElementById(ele_id);

            if($("#question-"+ele_id).val().trim()=="")
            {
                swal("Error", "Please enter answer.", "error");
                return;
            }
            $.ajax({
                url: "{{ url('mentor/submit-answer') }}",
                data:{id:ele_id,
                answer:$("#question-"+ele_id).val()
                },
                type:'post',
                success: function(result) {
                    swal("Success", "Answer submitted successfully!.", "success");
                    $("#question-"+ele_id).prop("disabled", true)
                    $(btn).hide();
                }
            });
        }
        var loadFile = function(event) {
                var output = document.getElementById('profile-image-preview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };

        var loadPostFile = function(event) {
                var output = document.getElementById('post-image-preview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };

       
        function loadNewContent(){
            loading = false;
            var language_id = $(".mentor_filters #language_id_filter").val();
            // console.log(language_id);
            var topic_id = $(".mentor_filters #topic_id").val();
            // console.log("topic_id",topic_id);
            var standard_id = $(".mentor_filters #standard_id").val();
            var category_id = $(".mentor_filters #category_id").val();
            $.ajax({
                type:'POST',
                url: '{{url("mentor/ajax-load-more-post-mentor")}}',
                data:{ 
                    page: page,
                    mentor_id: {{Auth::user()->id}},
                    language_id:language_id,
                    topic_id:topic_id,
                    standard_id:standard_id,
                    category_id:category_id
                },
                success:function(data){
                    if(data != ""){
                        $("#div-to-update").append(data);
                        page++;
                        loading = true;
                        $(".profile-content-section").addClass("card shadow-sm p-3 mt-4 rounded post-card");
                    }else{
                        loading = false;
                    }
                }
            });
        }

//scroll DIV's Bottom
// $(window).scroll(function() {
//     console.log("scroll called");
//     if($(window).scrollTop() == $(document).height() - $(window).height()) {
//         console.log("loading",loading);
//         if(loading)
//         {
//             loadNewContent()
//         }
//     }
// });

function filterPost(){

    page = 1;
    var language_id = $(".mentor_filters #language_id_filter").val();
    // console.log(language_id);
    var topic_id = $(".mentor_filters #topic_id").val();
    // console.log("topic_id",topic_id);
    var standard_id = $(".mentor_filters #standard_id").val();
    var category_id = $(".mentor_filters #category_id").val();

       $.ajax({
           type:'POST',
           url: '{{url("mentor/ajax-load-more-post")}}',
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

$(window).scroll(function() {
     console.log($(window).scrollTop() + " " + $(document).height() +"  "+ $(window).height())
    if($(window).scrollTop() > $(document).height() - $(window).height()-100) {
        if(loading)
        {
            console.log('ssssssss')
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
            swal("Success", "Comment submitted successfully!", "success");

        }
    });
}

</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote();    
    });
    $('.richTextarea').summernote({
    height: 300,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']],
              
    ]
  });
</script> 
@endpush
