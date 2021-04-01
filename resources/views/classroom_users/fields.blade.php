<!-- Classroom Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('classroom_id', 'Pilih Kelas:') !!}
    <select name="classroom_id" class="form-control select2" style="width: 100%;">
        @foreach(App\Models\Classroom::all() as $data)
            <option {{ isset($classroomUser->classroom_id) && $classroomUser->classroom_id == $data->id ? 'selected' : '' }}  value="{{ $data->id}}">{{ $data->title}}</option>
        @endforeach
    </select>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Pilih Mahasiswa:') !!}
    <select name="user_id" class="form-control select2" style="width: 100%;">
        @foreach(App\Models\User::all() as $data)
            <option {{ isset($classroomUser->user_id) && $classroomUser->user_id == $data->id ? 'selected' : '' }}  value="{{ $data->id}}">{{ $data->name}}</option>
        @endforeach
    </select>
</div>

<!-- Last Accesed At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_accesed_at', 'Last Accesed At:') !!}
    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
        <input type="text" name="last_accesed_at" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>

   
</div>

@push('page_scripts')
    <script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            defaultDate: "{{ $classroomUser->last_accesed_at }}",
        });
    });
    </script>
@endpush 