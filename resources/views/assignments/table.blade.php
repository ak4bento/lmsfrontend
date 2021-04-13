<div class="table-responsive">
    <table class="table" id="assignments-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Description</th>
        <th>Created By</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assignments as $assignment)
            <tr>
                <td>{{ $assignment->title }}</td>
            <td>{{ $assignment->description }}</td>
            <td>{{ $assignment->created_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['assignments.destroy', $assignment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('assignments.show', [$assignment->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('assignments.edit', [$assignment->id]) }}" class='btn btn-default btn-xs'>
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
