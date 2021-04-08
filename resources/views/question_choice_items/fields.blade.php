<!-- Question Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_id', 'Question Id:') !!}
    {!! Form::number('question_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Choice Text Field -->
<div class="form-group col-sm-6">
    {!! Form::label('choice_text', 'Choice Text:') !!}
    {!! Form::text('choice_text', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Is Correct Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_correct', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_correct', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_correct', 'Is Correct', ['class' => 'form-check-label']) !!}
    </div>
</div>
