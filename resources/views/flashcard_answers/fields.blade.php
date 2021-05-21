<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Flashcard Questions Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flashcard_questions_id', 'Flashcard Questions Id:') !!}
    {!! Form::number('flashcard_questions_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Group Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group', 'Group:') !!}
    {!! Form::text('group', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Choice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('choice', 'Choice:') !!}
    {!! Form::text('choice', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>