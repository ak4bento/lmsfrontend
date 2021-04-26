@csrf
<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', 'Pilih Matakuliah:') !!}
    <select name="subject_id" class="form-control select2" id="subject_id" style="width: 100%;">
        @foreach (App\Models\Subject::all() as $data)
            <option {{ isset($classrooms->subject_id) && $classrooms->subject_id == $data->id ? 'selected' : '' }}
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
                {{ isset($classrooms->teaching_period_id) && $classrooms->teaching_period_id == $data->id ? 'selected' : '' }}
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
    <input type="text" class="form-control" value="{{ $classrooms->code }}" name="code">

</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Kelas:') !!}
    <input type="text" class="form-control" value="{{ $classrooms->title }}" name="title">
</div>

<!-- Start At Field -->
<div class="form-group col-sm-3">
    {!! Form::label('start_at', 'Mulai:') !!}
    <input type="time" class="form-control" name="start_at"
        value="{{ isset($classrooms->start_at) ? $classrooms->start_at : '' }}">
</div>

<!-- End At Field -->
<div class=" form-group col-sm-3">
    {!! Form::label('end_at', 'Selesai:') !!}
    <input type="time" class="form-control " name="end_at"
        value="{{ isset($classrooms->end_at) ? $classrooms->end_at : '' }}">
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Deskripsi:') !!}
    <input type="text" class="form-control" value="{{ $classrooms->description }}" name="description">
</div>
