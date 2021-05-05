<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Pilih Wewenang:') !!}
    <select name="role_id" class="form-control select2" id="role_id" style="width: 100%;">
        @foreach (App\Models\Role::all() as $data)
            <option
                value="{{ $data->id }}">{{ $data->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('model_id', 'Pilih Pengguna:') !!}
    <select name="model_id" class="form-control select2" id="model_id" style="width: 100%;">
        @foreach (App\Models\User::all() as $data)
            <option
                value="{{ $data->id }}">{{ $data->name }}
            </option>
        @endforeach
    </select>
</div>
 
