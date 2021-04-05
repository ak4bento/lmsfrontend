<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', 'Pilih Matakuliah:') !!}
    <select name="subject_id" class="form-control select2" id="subject_id" style="width: 100%;">
        @foreach (App\Models\Subject::all() as $data)
            <option {{ isset($classroom->subject_id) && $classroom->subject_id == $data->id ? 'selected' : '' }}
                value="{{ $data->id }}">{{ $data->title }}
            </option>
        @endforeach
    </select>
</div>

<!-- Teaching Period Id Field -->
<div class="form-group col-sm-3">
    {!! Form::label('teaching_period_id', 'Tahun Ajaran:') !!}
    <select name="teaching_period_id" class="form-control select2" id="teaching_period_id" style="width: 100%;">
        @foreach (App\Models\TeachingPeriod::all() as $data)
            <option
                {{ isset($classroom->teaching_period_id) && $classroom->teaching_period_id == $data->id ? 'selected' : '' }}
                value="{{ $data->id }}">{{ $data->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Slug Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div> --}}

<!-- Code Field -->
<div class="form-group col-sm-3">
    {!! Form::label('code', 'Kode:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Kelas:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Deskripsi:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Start At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'Mulai:') !!}
    <input type="time" class="form-control" name="start_at"
        value="{{ isset($classroom->start_at) ? $classroom->start_at : '' }}">
</div>

<!-- End At Field -->
<div class=" form-group col-sm-6">
    {!! Form::label('end_at', 'Selesai:') !!}
    <input type="time" class="form-control" name="end_at"
        value="{{ isset($classroom->end_at) ? $classroom->end_at : '' }}">
</div>

<!-- Created By Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div> --}}
