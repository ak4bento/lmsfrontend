<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{{ $flashcardSubject->subject }}</p>
</div>

<!-- Subject Type Field -->
<div class="col-sm-12">
    {!! Form::label('subject_type', 'Subject Type:') !!}
    <p>{{ $flashcardSubject->subject_type }}</p>
</div>

<!-- Reference Field -->
<div class="col-sm-12">
    {!! Form::label('reference', 'Reference:') !!}
    <p>{{ $flashcardSubject->reference }}</p>
</div>

<!-- External Link Field -->
<div class="col-sm-12">
    {!! Form::label('external_link', 'External Link:') !!}
    <p>{{ $flashcardSubject->external_link }}</p>
</div>

