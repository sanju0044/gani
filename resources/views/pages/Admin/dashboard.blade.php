@extends('layouts.app')

@section('content')
<style>
    /* General styles and container padding */
    .container {
        padding-top: 30px;
    }

    /* Profile Section */
    .show-profile-wrapper {
        background: linear-gradient(to right, #00a2cb, #007AA3); /* Existing blue gradient */
        color: #fff;
        padding: 25px 30px;
        margin-bottom: 35px;
        border-radius: 15px; /* Softer rounded corners */
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 8px 20px rgba(0, 162, 203, 0.3); /* Blue shadow */
    }
    .profile-image-section {
        display: flex;
        align-items: center;
    }
    .profile-image-section img {
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.8); /* Slightly transparent white border */
        width: 90px; /* Slightly larger image */
        height: 90px;
        object-fit: cover;
    }
    .profile-name-section {
        margin-left: 20px;
    }
    .profile-name-section h4 {
        margin: 0;
        font-weight: 800; /* Bolder name */
        font-size: 1.8rem;
    }
    .profile-name-section p {
        margin: 5px 0 0;
        font-size: 1.1rem;
        opacity: 0.9;
    }
    .profile-button-wrapper .btn {
        font-weight: 700;
        border-radius: 50px; /* Pill-shaped button */
        padding: 10px 25px;
        background-color: #fff;
        color: #00a2cb !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .profile-button-wrapper .btn:hover {
        background-color: #f0f0f0;
        transform: translateY(-2px);
    }
    .profile-button-wrapper .btn i {
        margin-right: 8px;
    }

    /* Small Box Cards - Colorful Gradients */
    .small-box {
        min-height: 180px; /* Taller cards */
        border-radius: 18px; /* More rounded */
        padding: 25px;
        color: #fff; /* White text for all cards */
        box-shadow: 0 10px 30px rgba(0,0,0,0.15); /* Stronger shadow */
        transition: all 0.4s ease; /* Smoother transitions */
        position: relative;
        overflow: hidden;
        margin-bottom: 25px; /* Consistent bottom margin */
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Space out content and footer */
    }
    .small-box:hover {
        transform: translateY(-8px) scale(1.02); /* More prominent lift and slight scale */
        box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    }

    /* Gradient definitions for each card type */
    .small-box.student { background: linear-gradient(135deg, #6dd5ed, #2193b0); } /* Blue-cyan */
    .small-box.mentor { background: linear-gradient(135deg, #f7b733, #fc4a1a); } /* Orange-yellow */
    .small-box.moderator { background: linear-gradient(135deg, #8360c3, #2ebf91); } /* Purple-green */
    .small-box.post-pending { background: linear-gradient(135deg, #ff7e5f, #feb47b); } /* Coral-peach */
    .small-box.qa-pending { background: linear-gradient(135deg, #4facfe, #00f2fe); } /* Light blue-aqua */
    .small-box.comment-pending { background: linear-gradient(135deg, #aa076b, #61045f); } /* Magenta-dark purple */
    .small-box.advertisement { background: linear-gradient(135deg, #fceabb, #f8b500); } /* Light yellow-gold */
    
    .small-box .inner h1 {
        font-size: 48px; /* Larger count */
        font-weight: 900;
        color: #fff; /* White for count */
        text-shadow: 2px 2px 6px rgba(0,0,0,0.2); /* Text shadow for depth */
        margin: 0;
    }
    .small-box .inner p {
        font-size: 18px; /* Larger text */
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9); /* Slightly subdued white */
        margin-top: 8px;
    }
    .small-box .icon {
        position: absolute;
        bottom: -10px; /* Positioned slightly off-card */
        right: -10px;
        font-size: 100px; /* Much larger icon */
        color: rgba(255, 255, 255, 0.15); /* Very light transparent white */
        z-index: 0; /* Behind text */
        transition: transform 0.4s ease;
    }
    .small-box:hover .icon {
        transform: scale(1.1); /* Zoom icon on hover */
    }
    .small-box-footer {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.2); /* Darker transparent background */
        border-radius: 0 0 15px 15px; /* Rounded only at bottom to match card */
        color: #fff;
        padding: 10px 0;
        font-weight: 700;
        text-decoration: none;
        position: absolute; /* Stick to bottom */
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1; /* Above icon */
        transition: background 0.3s ease;
    }
    .small-box-footer:hover {
        background: rgba(0, 0, 0, 0.35); /* Darker on hover */
        text-decoration: none; /* Keep underline off */
        color: #fff;
        transition: background 0.3s ease;
    }
    .small-box-footer i {
        margin-left: 8px;
        transition: margin-left 0.3s ease;
        color: #fff;
    }
    .small-box-footer:hover i {
        margin-left: 15px; /* Move arrow further on hover */
        color: #fff;
    }

    /* Responsive spacing */
    .row-spacing {
        margin-bottom: 20px;
    }

    /* Ensure text within the inner div is always above the icon */
    .small-box .inner {
        position: relative;
        z-index: 2; /* Make sure content is above icon */
    }
</style>
    {{-- Profile Section --}}
    <div class="row">
        <div class="col-12">
            <div class="show-profile-wrapper">
                <div class="profile-image-section">
                    <img src="{{ asset('/public/images/25boss4r210_fjpalm_1.png') }}" alt="Profile Image">
                    <div class="profile-name-section">
                        <h4>{{ ucfirst(Auth::user()->first_name) }} {{ ucfirst(Auth::user()->last_name) }}</h4>
                        <p>
                            @if(Auth::user()->moderator_type == 1) Super Admin
                            @elseif(Auth::user()->moderator_type == 2) Content Moderator
                            @elseif(Auth::user()->moderator_type == 3) Comment Moderator
                            @else Administrator
                            @endif
                        </p>
                    </div>
                </div>
                <div class="profile-button-wrapper">
                    <a href="{{ url('admin/profile') }}" class="btn">
                        <i class="fas fa-user-circle"></i> Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Dashboard Boxes --}}
    <div class="row row-spacing">

        {{-- Student --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-left student"> {{-- Added 'student' class for specific gradient --}}
                <div class="inner">
                    <h1>{{ $student_count }}</h1>
                    <p>STUDENT REGISTERED</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i> {{-- Changed icon for students --}}
                </div>
                <a href="{{ url('admin/students') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Mentor --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-left mentor"> {{-- Added 'mentor' class for specific gradient --}}
                <div class="inner">
                    <h1>{{ $mentor_count }}</h1>
                    <p>MENTORS ONBOARDED</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people"></i> {{-- Changed icon for mentors --}}
                </div>
                <a href="{{ url('admin/mentors') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Moderator --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-left moderator"> {{-- Added 'moderator' class for specific gradient --}}
                <div class="inner">
                    <h1>{{ $moderator_count }}</h1>
                    <p>MODERATORS ONBOARDED</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ url('admin/moderators') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        @if(Auth::user()->moderator_type == 1 || Auth::user()->moderator_type == 0)
        {{-- Post Pending --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-left post-pending"> {{-- Added 'post-pending' class --}}
                <div class="inner">
                    <h1>{{ $post_pending_count }}</h1>
                    <p>POSTS PENDING FOR APPROVAL</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i> {{-- Changed icon --}}
                </div>
                <a href="{{ url('admin/content-approval/Post/0') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endif

        @if(Auth::user()->moderator_type == 2 || Auth::user()->moderator_type == 0)
        {{-- Q/A Pending --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-left qa-pending"> {{-- Added 'qa-pending' class --}}
                <div class="inner">
                    <h1>{{ $qa_pending_count }}</h1>
                    <p>Q/A PENDING FOR APPROVAL</p>
                </div>
                <div class="icon">
                    <i class="ion ion-chatboxes"></i> {{-- Changed icon --}}
                </div>
                <a href="{{ url('admin/content-approval/Q&A/0') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endif

        @if(Auth::user()->moderator_type == 3 || Auth::user()->moderator_type == 0)
        {{-- Comments Pending --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-left comment-pending"> {{-- Added 'comment-pending' class --}}
                <div class="inner">
                    <h1>{{ $post_pending_comment_count }}</h1>
                    <p>COMMENTS PENDING FOR APPROVAL</p>
                </div>
                <div class="icon">
                    <i class="ion ion-chatbubble-working"></i> {{-- Changed icon --}}
                </div>
                <a href="{{ url('admin/content-approval/Comment/0') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endif

        {{-- Advertisement --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="small-box text-left advertisement"> {{-- Added 'advertisement' class --}}
                <div class="inner">
                    <h1>{{ $advertisment }}</h1>
                    <p>ADVERTISEMENTS</p> {{-- Changed text to plural --}}
                </div>
                <div class="icon">
                    <i class="ion ion-megaphone"></i> {{-- Changed icon --}}
                </div>
                <a href="{{ url('admin/advertisment') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div><br><br><br><br><br>

@endsection