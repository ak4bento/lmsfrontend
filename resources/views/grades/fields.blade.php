<!-- Gradeable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gradeable_id', 'Gradeable Id:') !!}
    {!! Form::number('gradeable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Gradeable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gradeable_type', 'Gradeable Type:') !!}
    {!! Form::text('gradeable_type', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Grading Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grading_method', 'Grading Method:') !!}
    {!! Form::text('grading_method', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Grade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grade', 'Grade:') !!}
    {!! Form::number('grade', null, ['class' => 'form-control']) !!}
</div>

<!-- Completed At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('completed_at', 'Completed At:') !!}
    {!! Form::text('completed_at', null, ['class' => 'form-control','id'=>'completed_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#completed_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Graded By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('graded_by', 'Graded By:') !!}
    {!! Form::number('graded_by', null, ['class' => 'form-control']) !!}
</div>