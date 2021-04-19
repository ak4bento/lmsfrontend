<!-- Classroom User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('classroom_user_id', 'Classroom User Id:') !!}
    {!! Form::number('classroom_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Teachable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teachable_id', 'Teachable Id:') !!}
    {!! Form::number('teachable_id', null, ['class' => 'form-control']) !!}
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