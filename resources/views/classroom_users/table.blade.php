<div class="table-responsive">
    <table class="table" id="classroomUsers-table">
        <thead>
            <tr>
                <th>Classroom Id</th>
                <th>User Id</th>
                <th>Last Accesed At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classroomUsers as $classroomUser)
                <tr>
                    <td>{{ $classroomUser->classroom_id }}</td>
                    <td>{{ $classroomUser->user_id }}</td>
                    <td>{{ $classroomUser->last_accesed_at }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['classroomUsers.destroy', $classroomUser->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('classroomUsers.show', [$classroomUser->id]) }}"
                                class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('classroomUsers.edit', [$classroomUser->id]) }}"
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
