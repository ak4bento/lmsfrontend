<!-- Flashcard Categories Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('flashcard_categories_id', 'Flashcard Categories:') !!}
    {{-- {!! Form::number('flashcard_categories_id', null, ['class' => 'form-control']) !!} --}}
    <select name="flashcard_categories_id" class="form-control select2" id="flashcard_categories_id" style="width: 100%;">
        @foreach (App\Models\FlashcardCategories::all() as $data)
            <option
                value="{{ $data->id }}">{{ $data->category }}
            </option>
        @endforeach
    </select>
</div>

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'form-control']) !!}
</div>

<!-- Explanation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('explanation', 'Explanation:') !!}
    {!! Form::text('explanation', null, ['class' => 'form-control']) !!}
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
