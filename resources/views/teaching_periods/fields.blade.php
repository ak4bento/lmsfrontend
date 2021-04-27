<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Tahun Ajaran:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div>

<!-- Start At Field -->
<div class="form-group col-sm-3">
    {!! Form::label('start_at', 'Mulai:') !!}
    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
        <input type="text" name="start_at" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>

<!-- End At Field -->
<div class="form-group col-sm-3">
    {!! Form::label('end_at', 'Selesai:') !!}
    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
        <input type="text" name="end_at" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker({
                defaultDate: "{{ isset($teachingPeriod) ? $teachingPeriod->start_at : '' }}",
                locale: 'id'
            });
        });

    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker2').datetimepicker({
                defaultDate: "{{ isset($teachingPeriod) ? $teachingPeriod->end_at : '' }}",
                locale: 'id'
            });
        });

    </script>
@endpush
