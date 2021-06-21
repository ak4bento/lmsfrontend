<!-- Flashcard Categories Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flashcard_categories_id', 'Flashcard Categories :') !!}
    <select name="flashcard_categories_id" class="form-control select2" id="flashcard_categories_id"
        style="width: 100%;">
        @foreach (App\Models\FlashcardCategories::where('level',4)->get() as $item)
        <option value="{{ $item->id }}">
            {{ $item->category }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
</div>

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Explanation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('explanation', 'Explanation:') !!}
    {!! Form::text('explanation', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Images Field -->
<div class="form-group col-sm-6">
    {!! Form::label('images', 'Images Question:') !!}
    {{-- {!! Form::text('images', null, ['class' => 'form-control']) !!} --}}
    {!! Form::file('images', null, ['class' => 'form-control']) !!}
</div>

<!-- Images Explanation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('images_explanation', 'Images Explanation:') !!}
    {{-- {!! Form::text('images_explanation', null, ['class' => 'form-control']) !!} --}}
    {!! Form::file('images_explanation', null, ['class' => 'form-control']) !!}
</div>