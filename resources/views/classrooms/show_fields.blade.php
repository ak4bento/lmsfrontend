<!-- Subject Id Field -->
<div class="col-sm-12">
    {!! Form::label('subject_id', 'Subject Id:') !!}
    <p>{{ $classroom->subject_id }}</p>
</div>

<!-- Teaching Period Id Field -->
<div class="col-sm-12">
    {!! Form::label('teaching_period_id', 'Teaching Period Id:') !!}
    <p>{{ $classroom->teaching_period_id }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $classroom->slug }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $classroom->code }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $classroom->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $classroom->description }}</p>
</div>

<!-- Start At Field -->
<div class="col-sm-12">
    {!! Form::label('start_at', 'Start At:') !!}
    <p>{{ $classroom->start_at }}</p>
</div>

<!-- End At Field -->
<div class="col-sm-12">
    {!! Form::label('end_at', 'End At:') !!}
    <p>{{ $classroom->end_at }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $classroom->created_by }}</p>
</div>

