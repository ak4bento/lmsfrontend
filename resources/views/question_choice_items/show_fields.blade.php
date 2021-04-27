<!-- Question Id Field -->
<div class="col-sm-12">
    {!! Form::label('question_id', 'Question Id:') !!}
    <p>{{ $questionChoiceItem->question_id }}</p>
</div>

<!-- Choice Text Field -->
<div class="col-sm-12">
    {!! Form::label('choice_text', 'Choice Text:') !!}
    <p>{{ $questionChoiceItem->choice_text }}</p>
</div>

<!-- Is Correct Field -->
<div class="col-sm-12">
    {!! Form::label('is_correct', 'Is Correct:') !!}
    <p>{{ $questionChoiceItem->is_correct }}</p>
</div>

