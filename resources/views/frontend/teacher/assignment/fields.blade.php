<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<input type="hidden" name="classroom_id" value="{{ $classrooms->id }}" />

<input type="hidden" name="slug" value="{{ $classrooms->slug }}" />

<div class="form-group col-sm-12 col-md-12 col-lg-12">
    <label for="">Judul :</label>
    <input type="text" value="{{ isset($assignments) ? $assignments->title : '' }}" name="title" class="form-control">
</div>

{{-- max_attempts_count --}}
<div class="form-group col-sm-12 col-md-6 col-lg-3">
    <label for="">Jumlah Maksimal Mencoba:</label>
    <input type="number" value="{{ isset($teachable) ? $teachable->max_attempts_count : '' }}"
        name="max_attempts_count" min="1" class="form-control">
</div>

{{-- pass_threshold --}}
<div class="form-group col-sm-12 col-md-6 col-lg-3">
    <label for="">Nilai Batas Minimum:</label>
    <input type="number" value="{{ isset($teachable) ? $teachable->pass_threshold : '' }}" name="pass_threshold"
        class="form-control">
</div>

<!-- available_at -->
<div class="form-group col-sm-12 col-md-6 col-lg-3">
    <label for="">Mulai:</label>
    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
        <input type="text" name="available_at" class="form-control datetimepicker-input"
            data-target="#datetimepicker1" />
        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>

{{-- expires_at --}}
<div class="form-group col-sm-12 col-md-6 col-lg-3">
    <label for="">Selesai:</label>

    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
        <input type="text" name="expires_at" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>

{{-- description --}}
<div class="form-group col-sm-12 col-md-12 col-lg-12">
    <label for="">Deskripsi :</label>
    <textarea id="Deskripsi" name="description"
        class="form-control">{{ isset($assignments) ? $assignments->description : '' }}</textarea>
</div>

@push('page_scripts')
    <script>
        var konten = document.getElementById("Deskripsi");
        CKEDITOR.replace(konten, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;

    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker({
                defaultDate: "{{ isset($teachable) ? $teachable->available_at : '' }}",
                locale: 'id'
            });
        });

    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker2').datetimepicker({
                defaultDate: "{{ isset($teachable) ? $teachable->expires_at : '' }}",
                locale: 'id'
            });
        });

    </script>
@endpush
