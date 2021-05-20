<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', 'Level :') !!}
    <select name="level" class="form-control select2" id="level" style="width: 100%;">
        <option value="1">Level Kategori 1</option>
        <option value="2">Level Kategori 2</option>
        <option value="3">Level Kategori 3</option>
        <option value="4">Level Kategori 4</option>
    </select>
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', 'Parent:') !!}
    {{-- {!! Form::number('parent_id', null, ['class' => 'form-control']) !!} --}}
    <select name="parent_id" class="form-control select2" id="parent_id" style="width: 100%;">
        <option
            value="0">Kategori Utama
        </option>
        @foreach (App\Models\FlashcardCategories::all() as $data)
            <option
                value="{{ $data->id }}">{{ $data->category }}
            </option>
        @endforeach
    </select>
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>
