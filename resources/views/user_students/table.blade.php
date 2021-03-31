<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
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
        @foreach($userStudents as $userStudent)
            <tr>
                <td>{{ $userStudent->name }}</td>
                <td>{{ $userStudent->email }}</td>
                <td>{{ $userStudent->email_verified_at }}</td>
                <td>{{ $userStudent->password }}</td>
                <td>{{ $userStudent->remember_token }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['userStudents.destroy', $userStudent->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('userStudents.show', [$userStudent->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('userStudents.edit', [$userStudent->id]) }}" class='btn btn-default btn-xs'>
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
