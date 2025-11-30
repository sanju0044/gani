@extends('layouts.app')

@section('content')
<style>
    .gallery-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .video-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: 0.3s;
    }

    .video-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.12);
    }

    /* Video Responsive */
    .video-frame {
        width: 100%;
        aspect-ratio: 16/9;
        border-radius: 10px;
        border: none;
    }

    .header-box {
        background: #00a2cb;
        color: #fff;
        padding: 15px;
        margin-bottom: 25px;
        border-radius: 8px;
        text-align: center;
    }

</style>

<div class="container card-box mb-30">

    <div class="header-box">
        <h3>Uploaded Videos</h3>
    </div>

    <div class="gallery-wrapper">
        @foreach($stud_video as $obj)
            <div class="video-card">
                <iframe class="video-frame" src="{{ $obj }}" allowfullscreen></iframe>
            </div>
        @endforeach
    </div>

</div>
<br><br><br>
@endsection

@push('scripts')
<script>
</script>
@endpush
