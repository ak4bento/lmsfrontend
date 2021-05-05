<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Nomor Hp</th>
                <th>Wewenang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userStudents as $userStudent)
            <tr>
                <td>{{ $userStudent->name }}</td>
                <td>{{ $userStudent->email }}</td>
                <td>
                    {{ App\Models\Profile::where('user_id', $userStudent->id)->first()->full_name ?? 'Belum Diinput' }}
                </td>
                <td>
                    {{ App\Models\Profile::where('user_id', $userStudent->id)->first()->address ?? 'Belum Diinput' }}
                </td>
                <td>
                    {{ App\Models\Profile::where('user_id', $userStudent->id)->first()->phone_number ?? 'Belum Diinput' }}
                </td>
                <td>
                    {{ App\Models\Role::find(App\Models\ModelHasRole::where('model_id', $userStudent->id)->first()->role_id)->name ?? 'Belum Diinput' }}
                </td>
                <td width="120">
                    <!-- <div class='btn-group'> -->
                    <a href="{{ route('userStudents.show', [$userStudent->id]) }}" class='btn btn-info btn-sm'>
                        <i class="far fa-eye"></i>
                    </a>
                    <a href="{{ route('userStudents.edit', [$userStudent->id]) }}" class='btn btn-primary btn-sm'>
                        <i class="far fa-edit"></i>
                    </a>
                    <button class="btn btn-danger btn-sm delete" data-id="{{ $userStudent->id }}"
                        data-url="userStudents">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <!-- </div> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>