<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Start At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'Start At:') !!}
    {!! Form::text('start_at', null, ['class' => 'form-control','id'=>'start_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#start_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- End At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_at', 'End At:') !!}
    {!! Form::text('end_at', null, ['class' => 'form-control','id'=>'end_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#end_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush