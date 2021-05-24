<!-- Flashcard Questions Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flashcard_questions_id', 'Flashcard Questions Id:') !!}
    {!! Form::number('flashcard_questions_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Flashcard Categories Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('flashcard_categories_id', 'Flashcard Categories Id:') !!}
    {{-- {!! Form::number('flashcard_categories_id', null, ['class' => 'form-control']) !!} --}}
    <select name="flashcard_categories_id" class="form-control select2" id="flashcard_categories_id" style="width: 100%;">
        @foreach (App\Models\FlashcardCategories::where('level',4)->get() as $data)
            <option
                value="{{ $data->id }}">{{ $data->category }}
            </option>
        @endforeach
    </select>
</div>
