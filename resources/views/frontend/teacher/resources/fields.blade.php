@push('page_css')
@endpush

<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<input type="hidden" name="classroom_id" value="{{ $classrooms->id }}" />

<input type="hidden" name="slug" value="{{ $classrooms->slug }}" />

<div class="form-group col-sm-12 col-md-12 col-lg-12">
    <label for="">Judul :</label>
    <input type="text" value="{{ isset($assignments) ? $assignments->title : '' }}" name="title"
        placeholder="Judul Materi" class="form-control">
</div>


{{-- description --}}
<div class="form-group col-sm-12 col-md-12 col-lg-12">
    <label for="">Deskripsi :</label>
    <textarea id="Deskripsi" name="description"
        class="form-control">{{ isset($assignments) ? $assignments->description : '' }}</textarea>
</div>

<div class="form-group col-sm-12 col-md-12 col-lg-12">
    <label for="customFile">File Materi</label>

    <div class="custom-file">
        <input type="file" class="custom-file-input" id="file" name="file">
        <label class="custom-file-label" for="file">Pilih file</label>
    </div>
</div>

@push('page_scripts')
    <script>
        var konten = document.getElementById("Deskripsi");
        CKEDITOR.replace(konten, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;

    </script>
@endpush
