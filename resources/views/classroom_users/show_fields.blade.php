<!-- Classroom Id Field -->
<div class="col-sm-12">
    {!! Form::label('classroom_id', 'Classroom Id:') !!}
    <p>{{ $classroomUser->classroom_id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $classroomUser->user_id }}</p>
</div>

<!-- Last Accesed At Field -->
<div class="col-sm-12">
    {!! Form::label('last_accesed_at', 'Last Accesed At:') !!}
    <p>{{ $classroomUser->last_accesed_at }}</p>
</div>

