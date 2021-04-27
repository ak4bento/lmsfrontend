<!-- Question Type Field -->
<div class="col-sm-12">
    {!! Form::label('question_type', 'Question Type:') !!}
    <p>{{ $question->question_type }}</p>
</div>

<!-- Answers Field -->
<div class="col-sm-12">
    {!! Form::label('answers', 'Answers:') !!}
    <p>{{ $question->answers }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $question->content }}</p>
</div>

<!-- Scoring Method Field -->
<div class="col-sm-12">
    {!! Form::label('scoring_method', 'Scoring Method:') !!}
    <p>{{ $question->scoring_method }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $question->created_by }}</p>
</div>

