@push('page_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<input type="hidden" name="classroom_id" value="{{ $classrooms->id }}" />

<input type="hidden" name="slug" value="{{ $classrooms->slug }}" />

<div class="form-group col-sm-12 col-md-6 col-lg-9">
    <label for="">Judul :</label>
    <input type="text" value="{{ isset($assignments) ? $assignments->title : '' }}" name="title" class="form-control">
</div>

<div class="form-group col-sm-12 col-md-6 col-lg-3">
    <label for="user_id">Pilih Partisipan : </label>
    <select name="user_id[]" class="selectpicker my-select form-control" multiple data-actions-box="true" multiple
        data-style="btn-default" data-live-search="true" id="user_id">
        @if (isset($teachableUser) && $teachableUser->count() != 0)
            @foreach ($user as $data)
                 
                @if(App\Models\TeachableUser::where('classroom_user_id',$data->classroom_user_id)->where('teachable_id',$teachable->id)->first())
                
                <option value="{{ $data->user_id }}" {{ $data->user_id  ? 'selected' : '' }}>
                    {{ $data->name }}</option>
                @else
                <option value="{{ $data->user_id }}" >
                    {{ $data->name }}</option>
                @endif
            @endforeach
        @else
            @foreach ($user as $data)
                <option value="{{ $data->user_id }}" {{ isset($teachableUser) ? '' : 'selected' }}>
                    {{ $data->name }}
                </option>
            @endforeach
        @endif
    </select>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        var konten = document.getElementById("Deskripsi");
        CKEDITOR.replace(konten, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;
        $(function() {
            $('.my-select').selectpicker();
        });
        // $(document).ready(function() {
        //     $('.js-example-basic-multiple').select2({
        //         theme: "bootstrap4",

        //     });
        // });

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
