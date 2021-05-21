<!-- Question Field -->
<div class="col-sm-12">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $flashcardQuestion->question }}</p>
</div>

<!-- Images Field -->
<div class="col-sm-12">
    {!! Form::label('images', 'Images:') !!}
    <p><img src="/flashcardfiles/images/{{ $flashcardQuestion->images }}" alt="" width="200px" height="200px"></p>
</div>

<!-- Explanation Field -->
<div class="col-sm-12">
    {!! Form::label('explanation', 'Explanation:') !!}
    <p>{{ $flashcardQuestion->explanation }}</p>
</div>

<!-- Images Explanation Field -->
<div class="col-sm-12">
    {!! Form::label('images_explanation', 'Images Explanation:') !!}
    <p><img src="/flashcardfiles/images_explanation/{{ $flashcardQuestion->images_explanation }}" alt="" width="200px" height="200px"></p>
    <p></p>
</div>

