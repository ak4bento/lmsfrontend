<!-- Flashcard Categories Id Field -->
<div class="col-sm-12">
    {!! Form::label('flashcard_categories_id', 'Flashcard Categories Id:') !!}
    <p>{{ $flashcardQuestion->flashcard_categories_id }}</p>
</div>

<!-- Question Field -->
<div class="col-sm-12">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $flashcardQuestion->question }}</p>
</div>

<!-- Images Field -->
<div class="col-sm-12">
    {!! Form::label('images', 'Images:') !!}
    <p>{{ $flashcardQuestion->images }}</p>
</div>

<!-- Explanation Field -->
<div class="col-sm-12">
    {!! Form::label('explanation', 'Explanation:') !!}
    <p>{{ $flashcardQuestion->explanation }}</p>
</div>

<!-- Images Explanation Field -->
<div class="col-sm-12">
    {!! Form::label('images_explanation', 'Images Explanation:') !!}
    <p>{{ $flashcardQuestion->images_explanation }}</p>
</div>

