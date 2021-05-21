<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $flashcardAnswer->user_id }}</p>
</div>

<!-- Flashcard Questions Id Field -->
<div class="col-sm-12">
    {!! Form::label('flashcard_questions_id', 'Flashcard Questions Id:') !!}
    <p>{{ $flashcardAnswer->flashcard_questions_id }}</p>
</div>

<!-- Group Field -->
<div class="col-sm-12">
    {!! Form::label('group', 'Group:') !!}
    <p>{{ $flashcardAnswer->group }}</p>
</div>

<!-- Choice Field -->
<div class="col-sm-12">
    {!! Form::label('choice', 'Choice:') !!}
    <p>{{ $flashcardAnswer->choice }}</p>
</div>

