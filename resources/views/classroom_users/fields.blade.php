<!-- Classroom Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('classroom_id', 'Pilih Kelas:') !!}
    <select name="classroom_id" class="form-control select2" id="classroom_id" style="width: 100%;">
        @foreach (App\Models\Classroom::all() as $data)
            <option
                {{ isset($classroomUser->classroom_id) && $classroomUser->classroom_id == $data->id ? 'selected' : '' }}
                value="{{ $data->id }}">{{ $data->title }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('code', 'Kode Kelas:') !!}
    <input type="text" disabled name="code" id="code" class="form-control" placeholder="Kode Kelas">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'Mulai:') !!}
    <input type="text" disabled name="start_at" id="start_at" class="form-control" placeholder="Mulai">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('end_at', 'Selesai:') !!}
    <input type="text" disabled name="end_at" id="end_at" class="form-control" placeholder="Selesai">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('subject', 'Mata Kuliah:') !!}
    <input type="text" disabled name="subject" id="subject" class="form-control" placeholder="Mata Kuliah">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('teaching_periods', 'Periode Mengajar   :') !!}
    <input type="text" disabled name="teaching_periods" id="teaching_periods" class="form-control"
        placeholder="Periode Mengajar">
</div>

<!-- User Id Field -->
<input type="hidden" name="user_id" id="user_id"
    value="{{ isset($userStudent) ? App\Models\User::find($userStudent->id)->first()->id : '' }}">

<div class="form-group col-sm-6">
    {!! Form::label('full_name', 'Nama Lengkap   :') !!}
    <input type="text" disabled name="full_name"
        value="{{ isset($userStudent) && isset(App\Models\Profile::where('user_id', $userStudent->id)->first()->full_name) ? App\Models\Profile::where('user_id', $userStudent->id)->first()->full_name : '' }}"
        id="full_name" class="form-control" placeholder="Nama Lengkap">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email   :') !!}
    <input type="text" disabled name="email" id="email" class="form-control" placeholder="Email"
        value="{{ isset($userStudent) ? App\Models\User::find($userStudent->id)->first()->email : '' }}">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Nomor Hp   :') !!}
    <input type="text" disabled name="phone_number" id="phone_number" class="form-control" placeholder="Nomor Hp"
        value="{{ isset($userStudent) && isset(App\Models\Profile::where('user_id', $userStudent->id)->first()->phone_number) ? App\Models\Profile::where('user_id', $userStudent->id)->first()->phone_number : '' }}">
</div>

<!-- Last Accesed At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_accesed_at', 'Last Accesed At:') !!}
    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
        <input type="text" name="last_accesed_at" class="form-control datetimepicker-input"
            data-target="#datetimepicker1" />
        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>

@push('page_scripts')
    <script type='text/javascript'>
        $(document).ready(function() {
            // Department Change
            $('#classroom_id').change(function() {
                var id = $(this).val();
                console.log("ini ID :", id);
                var rute = "{{ url('get-classrooms') }}/" + id;
                console.log("ini ID :", rute);

                $.ajax({
                    url: rute,
                    type: 'get',
                    success: function(response) {
                        console.log("ini re :", response);
                        $.each(response, function(key, value) {
                            $("#code").val(response.code);
                            $("#description").val(response.description);
                            $("#start_at").val(response.start_at);
                            $("#end_at").val(response.end_at);
                            $("#teaching_periods").val(response.teaching_periods);
                            $("#subject").val(response.subject);
                        });

                    }
                });
            });
            $('#user_id').change(function() {
                var id = $(this).val();
                console.log("ini ID :", id);
                var rute = "{{ url('get-user-students') }}/" + id;
                // console.log("ini ID :", rute);

                $.ajax({
                    url: rute,
                    type: 'get',
                    success: function(response) {
                        console.log("ini re :", response);
                        $.each(response, function(key, value) {
                            $("#full_name").val(response.full_name);
                            $("#phone_number").val(response.phone_number);
                            $("#email").val(response.email);
                        });
                    }
                });
            });
        });

    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker({
                defaultDate: "{{ isset($classroomUser) ? $classroomUser->last_accesed_at : '' }}",
                locale: 'id'

            });
        });

    </script>
@endpush
