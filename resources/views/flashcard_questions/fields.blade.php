<!-- Flashcard Categories Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flashcard_categories_id', 'Flashcard Categories Id:') !!}
    {!! Form::number('flashcard_categories_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Images Field -->
<div class="form-group col-sm-6">
    {!! Form::label('images', 'Images:') !!}
    {!! Form::text('images', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Explanation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('explanation', 'Explanation:') !!}
    {!! Form::text('explanation', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Images Explanation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('images_explanation', 'Images Explanation:') !!}
    {!! Form::text('images_explanation', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>