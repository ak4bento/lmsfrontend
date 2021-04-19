<!-- Classroom User Id Field -->
<div class="col-sm-12">
    {!! Form::label('classroom_user_id', 'Classroom User Id:') !!}
    <p>{{ $teachableUser->classroom_user_id }}</p>
</div>

<!-- Teachable Id Field -->
<div class="col-sm-12">
    {!! Form::label('teachable_id', 'Teachable Id:') !!}
    <p>{{ $teachableUser->teachable_id }}</p>
</div>

<!-- Completed At Field -->
<div class="col-sm-12">
    {!! Form::label('completed_at', 'Completed At:') !!}
    <p>{{ $teachableUser->completed_at }}</p>
</div>

