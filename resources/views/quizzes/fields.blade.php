<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Judul:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div>
<div class="form-group col-sm-6">
</div>
<!-- Description Field -->
<div class="form-group col-sm-6 col-sm-6">
    {!! Form::label('description', 'Deskripsi:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

@if (isset($question_quizzes))
    <div class="form-group col-sm-12 col-lg-12">
        <h3>
            Daftar Soal

            <hr>
        </h3>
    </div>

    <div class="form-group col-sm-12 col-lg-12">
        <table id="example2" class="table table-bordered " style="width: 100%">
            <thead>
                <tr>
                    <th>Pertanyaan</th>
                    <th width="200">Dibuat Oleh</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($question_quizzes as $question_quizze)
                    <tr>
                        <td>{!! $question_quizze->content !!} </td>
                        <td> {{ App\Models\User::find($question_quizze->created_by)->name }} </td>
                        <td width="120">
                            <a href="{{ route('questions.edit', [$question_quizze->id]) }}"
                                class='btn btn-primary btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
<div class="form-group col-sm-12 col-lg-12" style="margin-top: 40px">
    <h3>
        Petakan pada Kelas

        <hr>
    </h3>
</div>

{{-- max_attempts_count --}}
<div class="form-group col-sm-3 col-sm-3">
    {!! Form::label('max_attempts_count', 'Jumlah Maksimal Mencoba:') !!}
    <input type="number" value="{{ isset($teachable) ? $teachable->max_attempts_count : '' }}"
        name="max_attempts_count" min="1" class="form-control">
</div>

{{-- pass_threshold --}}
<div class="form-group col-sm-3 col-sm-3">
    {!! Form::label('pass_threshold', 'Nilai Batas Minimum:') !!}
    <input type="number" value="{{ isset($teachable) ? $teachable->pass_threshold : '' }}" name="pass_threshold"
        class="form-control">
</div>

<!-- available_at -->
<div class="form-group col-sm-3">
    {!! Form::label('available_at', 'Mulai:') !!}
    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
        <input type="text" name="available_at" class="form-control datetimepicker-input"
            data-target="#datetimepicker1" />
        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>

{{-- expires_at --}}
<div class="form-group col-sm-3">
    {!! Form::label('expires_at', 'Selesai:') !!}
    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
        <input type="text" name="expires_at" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>

<div class="form-group col-sm-12 col-lg-12">
    <table id="example1" class="table table-bordered ">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Periode Mengajar</th>
                <th>Kode Kelas</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Jam</th>
                <th>Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($classrooms as $classroom)
                <tr>
                    <td>
                        <input type="checkbox"
                            {{ isset($teachable) && isset(App\Models\Teachable::where('classroom_id', $classroom->id)->first()->id) ? 'checked' : '' }}
                            name="id[]" value="{{ $classroom->id }}" />
                        {{ App\Models\Subject::find($classroom->subject_id)->title }}
                    </td>
                    <td>{{ App\Models\TeachingPeriod::find($classroom->teaching_period_id)->name }}</td>
                    <td>{{ $classroom->code }}</td>
                    <td>{{ $classroom->title }}</td>
                    <td>{{ $classroom->description }}</td>
                    <td>{{ $classroom->start_at }} - {{ $classroom->end_at }}</td>
                    <td>{{ App\Models\User::find($classroom->created_by)->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('page_scripts')
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
