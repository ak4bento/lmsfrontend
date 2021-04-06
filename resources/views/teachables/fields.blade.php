<!-- Teachable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teachable_id', 'Teachable Id:') !!}
    {!! Form::number('teachable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Teachable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teachable_type', 'Teachable Type:') !!}
    {!! Form::text('teachable_type', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Classroom Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('classroom_id', 'Classroom Id:') !!}
    {!! Form::number('classroom_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Available At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('available_at', 'Available At:') !!}
    {!! Form::text('available_at', null, ['class' => 'form-control','id'=>'available_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#available_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Expires At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expires_at', 'Expires At:') !!}
    {!! Form::text('expires_at', null, ['class' => 'form-control','id'=>'expires_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#expires_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Final Grade Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('final_grade_weight', 'Final Grade Weight:') !!}
    {!! Form::number('final_grade_weight', null, ['class' => 'form-control']) !!}
</div>

<!-- Max Attempts Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_attempts_count', 'Max Attempts Count:') !!}
    {!! Form::number('max_attempts_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Pass Threshold Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pass_threshold', 'Pass Threshold:') !!}
    {!! Form::number('pass_threshold', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>