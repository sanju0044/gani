@foreach($pending_questions as $question)
@if(isset($question->student))
<div class="col-md-12" style="min-width: 50%">
    <div class="profile-content-section feedback-form-wrapper">
        <div class="question-ans-section">
            <div class="row">
                <div class="profile-post-image-section col-md-1 col-3">
                    @if ($question->student->profile_picture == null)
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLAFXK2MihEQSj_Udwnn1-lH6BDzU8cjq2JA&usqp=CAU" width="80" height="80">
                    @else
                    <img src="{{URL::to('/')}}/images/{{ $question->student->profile_picture }}" width="80" height="80">

                    @endif
                </div>
                <div class="col-md-10 col-9 comment-text section">
                    <h4>{{ucfirst($question->student->first_name)}} {{ucfirst($question->student->last_name)}}</h4>
                    <div style="border-bottom: 1px solid rgba(202, 202, 202, 0.933);">
                        <p>{{ucfirst($question->student->city)}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="post-content-section">
                    <p>
                        {{$question->question}}
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <textarea class="form-control" data-question-id="{{$question->id}}" id="question-{{$question->id}}" rows="3"></textarea>
            </div>
            <div class="col-md-12 text-right" style="margin-top:20px;">
                <button type="" class="btn btn-primary" onclick="submitAnswer(this, '{{$question->id}}')">Reply</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach


