<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Username:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'placeholder' => 'Username']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'placeholder' => 'Email']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#email_verified_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })

    </script>
@endpush

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Kata Sandi:') !!}
    <input type="password" name="password" class="form-control" placeholder="Kata Sandi">
</div>

<!-- Full Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('full_name', 'Nama Lengkap:') !!}
    <input type="text" name="full_name" value="{{ isset($profile) ? $profile->full_name : '' }}" class="form-control"
        placeholder="Nama Lengkap">
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    <input type="text" name="address" value="{{ isset($profile) ? $profile->address : '' }}" class="form-control"
        placeholder="Alamat">
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Nomor Hp:') !!}
    <input type="text" name="phone_number" value="{{ isset($profile) ? $profile->phone_number : '' }}"
        class="form-control" placeholder="Nomor Hp">
</div>
