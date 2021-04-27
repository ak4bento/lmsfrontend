<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Email Verified At</th>
                <th>Password</th>
                <th>Remember Token</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userTeachers as $userTeacher)
                <tr>
                    <td>{{ $userTeacher->name }}</td>
                    <td>{{ $userTeacher->email }}</td>
                    <td>{{ $userTeacher->email_verified_at }}</td>
                    <td>{{ $userTeacher->password }}</td>
                    <td>{{ $userTeacher->remember_token }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['userTeachers.destroy', $userTeacher->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('userTeachers.show', [$userTeacher->id]) }}"
                                class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('userTeachers.edit', [$userTeacher->id]) }}"
                                class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
