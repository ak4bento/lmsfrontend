<!-- Question Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_type', 'Question Type:') !!}
    {!! Form::text('question_type', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Answers Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('answers', 'Answers:') !!}
    {!! Form::textarea('answers', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Scoring Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scoring_method', 'Scoring Method:') !!}
    {!! Form::text('scoring_method', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>