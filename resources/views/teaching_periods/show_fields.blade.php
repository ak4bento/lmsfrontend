<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $teachingPeriod->name }}</p>
</div>

<!-- Start At Field -->
<div class="col-sm-12">
    {!! Form::label('start_at', 'Start At:') !!}
    <p>{{ $teachingPeriod->start_at }}</p>
</div>

<!-- End At Field -->
<div class="col-sm-12">
    {!! Form::label('end_at', 'End At:') !!}
    <p>{{ $teachingPeriod->end_at }}</p>
</div>

