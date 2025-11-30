@extends('layouts.app') 

@section('content')

<div class="container">
    <div class="pd-20 card-box mb-30">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @if ($data->mentor->profile_picture == null)
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU"
                            width="80" height="80" />
                    @else
                        <img src="{{URL::to('/')}}/images/{{ $data->mentor->profile_picture }}" width="80" height="80" />
                    @endif  
                    <div class="profile-name-section-1">
                        <h3> {{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}</h3>
                        <p>{{ $data->mentor->short_bio }}, {{ $data->mentor->city }}.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <a href="{{url('admin/content-approval')}}" class="btn btn-primary nav-link login-text"><i class="fas fa-arrow-left profile-icon"></i>Go Back</a>
                </div>
            </div>
        </div>
    </div> 
</div>  
<div class="container" style="padding-top: 25px;">
    <div class="pd-20 card-box mb-30">
        <div id="home" class="tab-pane fade show active">
            <div class="row section-first-post" >
                <div class="col-md-8">
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
                                <h4>{{ ucfirst($data->mentor->first_name) }} {{ ucfirst($data->mentor->last_name) }}</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="post-content-section">
                                <p>
                                    {!!$data->description!!}
                                </p>
                            </div>
                        </div>
                        @if($data->photo)
                            <div class="row">
                                <img src="{{URL::to('/')}}/images/{{$data->photo}}"
                                height="400" width="100%" id="post-image-preview" alt="post-image-preview" />  
                            </div>
                        @elseif($data->video!='?rel=0')
                            <div>
                            <iframe src="{{$data->video}}" frameborder="0" height="400" width="100%"></iframe>
                            </div>
                        @else($data->video=='' ?? $data->photo=='')
                            <div>
                            </div>
                        @endif
                        <br>

                        <div class="row commnents-writing-section" style="text-align: center">
                            <h3>Status: {{$data->status=='0'? 'Pending':($data->status=='1'?"Approved":"Disapproved")}}</h3>
                        </div>
                        <div class="row commnents-writing-section" style="text-align: center">

                            @if($data->status =="0")
                            <div class="col-md-2 col-3">
                                <a href="{{url('admin/content-approval1/approve/'.$data->id)}}"
                                    class="nav-link login-text">Approve</a>
                            </div>

                            <div class="col-md-2 col-3">
                                <a href="{{url('admin/content-approval1/disapprove/'.$data->id)}}"
                                    class="nav-link login-text">Disapprove</a>
                            </div>
                            @endif
                            <div class="col-md-2 col-3">
                                <a href="{{url('admin/content-approval')}}"
                                    class="btn btn-primary nav-link login-text">Back</a>
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
@section('js_script')


    <script>
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

        function publishPost() {
            var description = $("#description").val()
            if (description == "") {
                alert("Please enter description.")
                return;
            }


            $.ajax({
                url: "{{ url('mentor/publish-post') }}",
                type: 'post',
                data: {
                    description: description,

                },
                success: function(result) {
                    $("#description").val("");
                    swal("Success", result.message, "success");
                }
            });
        }
    </script>
@endsection
