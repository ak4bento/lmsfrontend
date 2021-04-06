<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $quizzes->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $quizzes->description }}</p>
</div>

<!-- Grading Method Field -->
<div class="col-sm-12">
    {!! Form::label('grading_method', 'Grading Method:') !!}
    <p>{{ $quizzes->grading_method }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $quizzes->created_by }}</p>
</div>

