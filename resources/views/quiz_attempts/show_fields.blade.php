<!-- Teachable User Id Field -->
<div class="col-sm-12">
    {!! Form::label('teachable_user_id', 'Teachable User Id:') !!}
    <p>{{ $quizAttempt->teachable_user_id }}</p>
</div>

<!-- Attempt Field -->
<div class="col-sm-12">
    {!! Form::label('attempt', 'Attempt:') !!}
    <p>{{ $quizAttempt->attempt }}</p>
</div>

<!-- Questions Field -->
<div class="col-sm-12">
    {!! Form::label('questions', 'Questions:') !!}
    <p>{{ $quizAttempt->questions }}</p>
</div>

<!-- Answers Field -->
<div class="col-sm-12">
    {!! Form::label('answers', 'Answers:') !!}
    <p>{{ $quizAttempt->answers }}</p>
</div>

<!-- Completed At Field -->
<div class="col-sm-12">
    {!! Form::label('completed_at', 'Completed At:') !!}
    <p>{{ $quizAttempt->completed_at }}</p>
</div>

<!-- Grading Method Field -->
<div class="col-sm-12">
    {!! Form::label('grading_method', 'Grading Method:') !!}
    <p>{{ $quizAttempt->grading_method }}</p>
</div>

