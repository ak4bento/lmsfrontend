<div class="table-responsive">
    <table class="table" id="teachableUsers-table">
        <thead>
            <tr>
                <th>Classroom User Id</th>
        <th>Teachable Id</th>
        <th>Completed At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachableUsers as $teachableUser)
            <tr>
                <td>{{ $teachableUser->classroom_user_id }}</td>
            <td>{{ $teachableUser->teachable_id }}</td>
            <td>{{ $teachableUser->completed_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['teachableUsers.destroy', $teachableUser->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('teachableUsers.show', [$teachableUser->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('teachableUsers.edit', [$teachableUser->id]) }}" class='btn btn-default btn-xs'>
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
