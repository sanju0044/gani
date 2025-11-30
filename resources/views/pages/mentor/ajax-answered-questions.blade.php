@foreach($answered_questions as $question)
@if(isset($question->student))
<div class="col-md-12">
    <div class="profile-content-section feedback-form-wrapper">
        <div class="question-ans-section">
            <div class="row">
                <div class="profile-post-image-section col-md-2">
                    @if ($question->student->profile_picture == null)
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="80" height="80">
                    @else
                    <img src="{{URL::to('/')}}/images/{{ $question->student->profile_picture }}" width="80" height="80">

                    @endif
                </div>
                <div class="col-md-10 comment-text section">
                    <h4>{{ucfirst($question->student->first_name)}} {{ucfirst($question->student->last_name)}}</h4>
                    <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                        <p>{{ucfirst($question->student->city_name)}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="post-content-section">
                    <h5>
                        {{$question->question}}
                    </h5>

                    <p>
                        {{$question->answer}}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endif
@endforeach
