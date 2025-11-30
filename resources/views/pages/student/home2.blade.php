@extends('layouts.app')

@section('content')

<div class="card">
    <div class="row">
        <div class="col-md-3 col-xs-2 col-sm-2 col-lg-3 profile-image-wrapper">
            <div class="profile-wrapper">
                <div class="profile-image-wrapper text-center">
                    <img src="{{asset('images/25boss4r210_fjpalm_1.png')}}" width="100" height="100">
                </div>
                <div class="text-center">
                    <div><h3>Amey Joshi</h3></div>
                    <div><p>Pune</p></div>
                    <div><p>8th Standard Abhinav Highschool</p></div>
                </div>
                <div class="text-center profile-image-div-third">
                    <div>
                        <a type="button" class="btn button-first">Interest 1</a>
                    </div>
                    <div>
                        <a type="button" class="btn button-second">Interest 2</a>
                    </div>
                    <div>
                        <a type="button" class="btn button-third">Interest 3</a>
                    </div>
                    <div>
                        <a type="button" class="btn button-first">Interest 3</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6 second-section-wrapper">
            <div class="text-center dropdown-section background-color-white">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Standard
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Subjects
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Language
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </div>
            </div>
            <div class="profile-content-section">
                <div class="row">
                    <div class="profile-post-image-section col-md-2">
                        <img src="{{asset('images/25boss4r210_fjpalm_1.png')}}" width="80" height="80">
                    </div>
                    <div class="col-md-10 post-text-content section">
                        <h4>Mrs. Vidhya Vikram</h4>
                        <div>
                            <p>1136 Followers</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="post-content-section">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus dictum rutrum in eget nisl. Aenean eget vulputate tellus. Aliquam fringilla nisi felis, vel convallis ligula interdum quis. Donec finibus, mauris ac porta accumsan, augue libero sagittis sapien, cursus accumsan metus nulla ut massa. Phasellus lorem sapien, porttitor euismod dui in, accumsan commodo eros. Proin odio mi, ultrices ac nunc id, mattis hendrerit dolor. Nunc interdum felis et lacus sodales, a molestie eros placerat.
                            Aliquam lacinia turpis augue, ac dapibus nulla scelerisque eu. Integer ullamcorper ipsum vitae mi pulvinar malesuada. Quisque condimentum ex blandit, interdum ipsum quis, aliquam lectus. Phasellus semper sagittis metus et laoreet. Duis commodo neque nec sapien aliquam, eget vestibulum libero convallis. Pellentesque vel tincidunt urna. Nunc convallis nibh nec nunc ultricies hendrerit. Donec id augue vel purus lacinia hendrerit. Pellentesque tempor venenatis mi. Quisque vitae nisl in odio imperdiet aliquam. Maecenas euismod posuere arcu et mattis. Aenean ut aliquet nulla. Nulla tincidunt, nisl ut egestas luctus, erat augue convallis ipsum, a ornare nunc ex a magna. Nulla ultricies sed augue ut feugiat. Curabitur lobortis, diam ac condimentum pharetra, mauris nunc hendrerit risus, semper accumsan sem orci id nisl. Sed ornare, mi vitae molestie commodo, quam nisi porttitor lorem, sit amet interdum sapien nulla pulvinar dolor.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <img src="{{asset('images/25boss4r210_fjpalm_1.png')}}" height="350" style="width:100%">
                </div>
                <div class="row like-comment-section">
                    <div class="col-md-6 col-6">
                        <a href="#"><i class="fas fa-thumbs-up"></i><span>15 Like</span></a>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <a href="#"><i class="fas fa-comments"></i><span>20 Comments</span></a>
                    </div>
                </div>
                <div class="row commnents-writing-section">
                    <div class="col-md-2 col-3">
                        <a href="#"><i class="fas fa-thumbs-up"></i><span>15 Like</span></a>
                    </div>
                    <div class="col-md-6 col-6 text-left">
                        <a href="#"><i class="fas fa-comments"></i><span>20 Comments</span></a>
                    </div>
                </div>
                <div class="row user-comment-wrapper">
                    <div class="user-comment-section col-md-1">
                        <img src="{{asset('images/25boss4r210_fjpalm_1.png')}}" width="50" height="50">
                    </div>
                    <div class="col-md-10 comment-text section">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Write a Comment.....">
                    </div>
                </div>
                <div class="row user-comment-wrapper">
                    <div class="user-comment-section col-md-1">
                        <img src="{{asset('images/25boss4r210_fjpalm_1.png')}}" width="45" height="45">
                    </div>
                    <div class="col-md-10 comment-text section">
                        <div>
                            <span>
                                <strong>Manisha Sharma</strong>
                                <small>1 Day ago</small>
                            </span>
                            <div>
                                <span>Hi Sir, I like your thoughts on this.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row user-comment-wrapper">
                    <div class="user-comment-section col-md-1">
                        <img src="{{asset('images/25boss4r210_fjpalm_1.png')}}" width="45" height="45">
                    </div>
                    <div class="col-md-10 comment-text section">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Write a Comment.....">
                    </div>
                </div>
            </div>
            <div class="profile-content-section">
                <div class="row">
                    <div class="profile-post-image-section col-md-2">
                        <img src="{{asset('images/25boss4r210_fjpalm_1.png')}}" width="80" height="80">
                    </div>
                    <div class="col-md-10 comment-text section">
                        <h4>Dr. Raghunath Mashelkar</h4>
                        <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                            <p>3000 Followers</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="post-content-section">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec dui in tellus dictum rutrum in eget nisl. Aenean eget vulputate tellus. Aliquam fringilla nisi felis, vel convallis ligula interdum quis. Donec finibus, mauris ac porta accumsan, augue libero sagittis sapien, cursus accumsan metus nulla ut massa. Phasellus lorem sapien, porttitor euismod dui in, accumsan commodo eros. Proin odio mi, ultrices ac nunc id, mattis hendrerit dolor. Nunc interdum felis et lacus sodales, a molestie eros placerat.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <iframe width="854" height="480" src="https://www.youtube.com/embed/qN3OueBm9F4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="row like-comment-section">
                    <div class="col-md-6 col-6">
                        <a href="#"><i class="fas fa-thumbs-up"></i><span>15 Like</span></a>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <a href="#"><i class="fas fa-comment"></i><span>20 Comments</span></a>
                    </div>
                </div>
                <div class="row commnents-writing-section">
                    <div class="col-md-2 col-3">
                        <a href="#"><i class="fas fa-thumbs-up"></i><span>15 Like</span></a>
                    </div>
                    <div class="col-md-6 text-left col-6">
                        <a href="#"><i class="fas fa-comments"></i><span>20 Comments</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-4 col-sm-4 col-lg-3 third-section-wrapper">
            <div class="row">
                <div class="col-md-12 col-12">
                    <img src="{{asset('images/advertise.png')}}">
                </div>
                <div class="col-md-12 col-12">
                    <img src="{{asset('images/advertise-2.png')}}" width="250" height="250">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
