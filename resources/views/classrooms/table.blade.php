<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Subject Id</th>
                <th>Teaching Period Id</th>
                <th>Slug</th>
                <th>Code</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start At</th>
                <th>End At</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($classrooms as $classroom)
            <tr>
                <td>{{ $classroom->subject_id }}</td>
                <td>{{ $classroom->teaching_period_id }}</td>
                <td>{{ $classroom->slug }}</td>
                <td>{{ $classroom->code }}</td>
                <td>{{ $classroom->title }}</td>
                <td>{{ $classroom->description }}</td>
                <td>{{ $classroom->start_at }}</td>
                <td>{{ $classroom->end_at }}</td>
                <td>{{ $classroom->created_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['classrooms.destroy', $classroom->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('classrooms.show', [$classroom->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('classrooms.edit', [$classroom->id]) }}" class='btn btn-default btn-xs'>
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
