@extends('layouts.app')

@section('content')
    <style>
        .student-profile-submit{
            width: 12% !important;
            margin-top:20px !important;
        }
    </style>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Edit Post</h4>
            </div>
        </div>
        <form class="form-signin profile-form" action="{{ url('admin/update/comment',$data->id) }}" id="profile" method="post" enctype="multipart/form-data">
        <div class="row">
            
            <div class="col-md-12">
                <div class="col-md-6 pr-2">
                    <img src="<?php if(!empty($data->photo)){echo asset('images/'.$data->photo);}else{ echo "https://i-goc.org/ibit/public/images/Image-Upload.png"; } ?>"
                    style="max-width:500px;border-radius: 0;" id="post-image-preview" alt="post-image-preview" />
                </div>
            </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ $data->mentor->first_name }}" id="first_name" class="form-control" required="" readonly>
                    </div>
                </div>    
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $data->mentor->last_name }}" id="first_name" class="form-control" placeholder="First Name" required="" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Comment Type</label>
                        <input type="text" name="first_name" value="{{ $data->content_type }}" id="first_name" class="form-control" required="" readonly>
                    </div>
                </div>    
                <div class="col-md-6">    
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $data->mentor->last_name }}" id="first_name" class="form-control" placeholder="First Name" required="" readonly>
                    </div>
                </div>
                <?php
                    if($data->content_type == 'post'){ ?>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Language</label>
                        <select name="language_id" id="language_id_filter" class="form-control my-0 py-1 amber-border" onchange="filterPost()">
                            <option value="">Language</option>
                            @foreach($languages as $language)
                            <option value="{{$language->id}}" <?php if($language->id == $data->language_id){ echo "selected"; }?>>{{$language->language}} </option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Topics</label>
                            <select name="topic_id" id="topic_id" class="form-control my-0 py-1 amber-border">
                                <option value="">Topics</option>
                                @foreach($topics as $topic)
                                    <option value="{{$topic->id}}" <?php if($topic->id == $data->topic_id){ echo "selected"; }?>>{{$topic->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Standard</label>
                            <select name="standard_id" id="standard_id" class="form-control my-0 py-1 amber-border">
                                <option value="">Standard</option>
                                @foreach($standards as $standard)
                                <option value="{{$standard->id}}" <?php if($standard->id == $data->standard_id){ echo "selected"; }?>>{{$standard->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categories</label>
                            <select name="category_id" id="category_id" class="form-control my-0 py-1 amber-border">
                                <option value="">Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" <?php if($category->id == $data->category_id){ echo "selected"; }?>>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Add Video URL:</label> <i class="fa fa-info-circle" aria-hidden="true" data-placement="bottom" title="1. On a computer, go to the YouTube video or playlist you want to embed.
                                    2. Click SHARE .
                                    3. From the list of Share options, click Embed.
                                    4. From the box that appears, copy the HTML code."></i>
                            <input type="text" id="url" name="post_video" class="form-control" placeholder="Add Video URL" value="{{ $data->video }}"  />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload a photo</label>
                            <input class="form-control" accept="image/*"  name="post_file" id="post_file" type="file"
                                onchange="loadPostFile(event)" />   
                        </div>
                    </div>
                <?php    }
                ?>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Post / Comment</label>
                        <textarea type="text" name="comment" class="summernote richTextarea form-control" id="other_details" rows="6" placeholder="Other Detail" required="">{!!$data->description !!}</textarea>
                    </div>
                </div>

                {{-- <div class="col-md-12">
                    <label>Add Description : </label>
                    <textarea class="summernote richTextarea" name="description"></textarea>
                </div> --}}
                <div class="col-md-12">
                    <button type="Submit" class="btn btn-primary student-profile-submit">Save</button>
                </div>

            </div>
        </div>
        </form>
    </div>
    <br>
    <br>
    <br>
@endsection

@section('js_script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        @if (Session::has('message'))
            swal("success", "{{ Session::get('message') }}", "success");
            @php
                Session::forget('message');
            @endphp
        @endif


        
    </script>
    <script type="text/javascript">
        var loadPostFile = function(event) {
                var output = document.getElementById('post-image-preview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
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
@endsection

