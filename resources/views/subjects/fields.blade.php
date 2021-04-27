<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Kode:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191, 'placeholder' => 'Kode Matakuliah']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Matakuliah:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191, 'placeholder' => 'Nama Matakuliah']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Deskripsi:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Deskripsi Matakuliah']) !!}
</div>

<!-- Default Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('default_category_id', 'Kategori:') !!}
    <select name="default_category_id" class="form-control select2" id="default_category_id" style="width: 100%;">
        <option value="1">
            kategori
        </option>
    </select>
</div>
