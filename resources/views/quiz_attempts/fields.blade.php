<!-- Teachable User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teachable_user_id', 'Teachable User Id:') !!}
    {!! Form::number('teachable_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Attempt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attempt', 'Attempt:') !!}
    {!! Form::number('attempt', null, ['class' => 'form-control']) !!}
</div>

<!-- Questions Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('questions', 'Questions:') !!}
    {!! Form::textarea('questions', null, ['class' => 'form-control']) !!}
</div>

<!-- Answers Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('answers', 'Answers:') !!}
    {!! Form::textarea('answers', null, ['class' => 'form-control']) !!}
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

<!-- Grading Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grading_method', 'Grading Method:') !!}
    {!! Form::text('grading_method', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>