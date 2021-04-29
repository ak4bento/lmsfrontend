<!-- Gradeable Id Field -->
<div class="col-sm-12">
    {!! Form::label('gradeable_id', 'Gradeable Id:') !!}
    <p>{{ $grade->gradeable_id }}</p>
</div>

<!-- Gradeable Type Field -->
<div class="col-sm-12">
    {!! Form::label('gradeable_type', 'Gradeable Type:') !!}
    <p>{{ $grade->gradeable_type }}</p>
</div>

<!-- Grading Method Field -->
<div class="col-sm-12">
    {!! Form::label('grading_method', 'Grading Method:') !!}
    <p>{{ $grade->grading_method }}</p>
</div>

<!-- Comments Field -->
<div class="col-sm-12">
    {!! Form::label('comments', 'Comments:') !!}
    <p>{{ $grade->comments }}</p>
</div>

<!-- Grade Field -->
<div class="col-sm-12">
    {!! Form::label('grade', 'Grade:') !!}
    <p>{{ $grade->grade }}</p>
</div>

<!-- Completed At Field -->
<div class="col-sm-12">
    {!! Form::label('completed_at', 'Completed At:') !!}
    <p>{{ $grade->completed_at }}</p>
</div>

<!-- Graded By Field -->
<div class="col-sm-12">
    {!! Form::label('graded_by', 'Graded By:') !!}
    <p>{{ $grade->graded_by }}</p>
</div>

