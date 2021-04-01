<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Username:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
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
    <input type="text" name="password" class="form-control" placeholder="Kata Sandi">
</div>
 
<!-- Full Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('full_name', 'Nama Lengkap:') !!}
    <input type="text" name="full_name" value="{{ $profile->full_name }}" class="form-control" placeholder="Nama Lengkap">
</div>


<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    <input type="text" name="address" value="{{ $profile->address }}" class="form-control" placeholder="Alamat">
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    <input type="text" name="phone_number" value="{{ $profile->phone_number }}" class="form-control" placeholder="Alamat">
</div>
 
 