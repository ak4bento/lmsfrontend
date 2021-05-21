<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{{ $flashcardSubject->subject }}</p>
</div>

<!-- Files Type Field -->
<div class="col-sm-12">
    {!! Form::label('files', 'Files:') !!}
    <p><img src="/flashcardfiles/files/{{ $flashcardSubject->files }}" alt="" width="200px"></p>
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

{
    ['https://jsonapi.org/examples/'],['https://stackoverflow.com/questions/38403558/get-an-image-extension-from-an-uploaded-file-in-laravel/38403610']
}
