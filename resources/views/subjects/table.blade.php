<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Slug</th>
                <th>Code</th>
                <th>Title</th>
                <th>Description</th>
                <th>Default Category Id</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->slug }}</td>
                <td>{{ $subject->code }}</td>
                <td>{{ $subject->title }}</td>
                <td>{{ $subject->description }}</td>
                <td>{{ $subject->default_category_id }}</td>
                <td>{{ $subject->created_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['subjects.destroy', $subject->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('subjects.show', [$subject->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('subjects.edit', [$subject->id]) }}" class='btn btn-default btn-xs'>
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
