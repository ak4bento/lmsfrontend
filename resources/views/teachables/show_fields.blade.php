<!-- Teachable Id Field -->
<div class="col-sm-12">
    {!! Form::label('teachable_id', 'Teachable Id:') !!}
    <p>{{ $teachable->teachable_id }}</p>
</div>

<!-- Teachable Type Field -->
<div class="col-sm-12">
    {!! Form::label('teachable_type', 'Teachable Type:') !!}
    <p>{{ $teachable->teachable_type }}</p>
</div>

<!-- Classroom Id Field -->
<div class="col-sm-12">
    {!! Form::label('classroom_id', 'Classroom Id:') !!}
    <p>{{ $teachable->classroom_id }}</p>
</div>

<!-- Available At Field -->
<div class="col-sm-12">
    {!! Form::label('available_at', 'Available At:') !!}
    <p>{{ $teachable->available_at }}</p>
</div>

<!-- Expires At Field -->
<div class="col-sm-12">
    {!! Form::label('expires_at', 'Expires At:') !!}
    <p>{{ $teachable->expires_at }}</p>
</div>

<!-- Final Grade Weight Field -->
<div class="col-sm-12">
    {!! Form::label('final_grade_weight', 'Final Grade Weight:') !!}
    <p>{{ $teachable->final_grade_weight }}</p>
</div>

<!-- Max Attempts Count Field -->
<div class="col-sm-12">
    {!! Form::label('max_attempts_count', 'Max Attempts Count:') !!}
    <p>{{ $teachable->max_attempts_count }}</p>
</div>

<!-- Order Field -->
<div class="col-sm-12">
    {!! Form::label('order', 'Order:') !!}
    <p>{{ $teachable->order }}</p>
</div>

<!-- Pass Threshold Field -->
<div class="col-sm-12">
    {!! Form::label('pass_threshold', 'Pass Threshold:') !!}
    <p>{{ $teachable->pass_threshold }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $teachable->created_by }}</p>
</div>

