<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Files Field -->
<div class="form-group col-sm-12">
    {!! Form::label('files', 'Files:') !!}
    {!! Form::file('files', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Type Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('subject_type', 'Subject Type:') !!}
    {!! Form::text('subject_type', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div> --}}

<!-- Reference Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reference', 'Reference:') !!}
    {!! Form::text('reference', null, ['class' => 'form-control']) !!}
</div>

<!-- External Link Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('external_link', 'External Link:') !!}
    {!! Form::text('external_link', null, ['class' => 'form-control']) !!}
</div>