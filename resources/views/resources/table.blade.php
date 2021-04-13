<div class="table-responsive">
    <table class="table" id="resources-table">
        <thead>
            <tr>
                <th>Type</th>
        <th>Title</th>
        <th>Data</th>
        <th>Description</th>
        <th>Created By</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($resources as $resource)
            <tr>
                <td>{{ $resource->type }}</td>
            <td>{{ $resource->title }}</td>
            <td>{{ $resource->data }}</td>
            <td>{{ $resource->description }}</td>
            <td>{{ $resource->created_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['resources.destroy', $resource->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('resources.show', [$resource->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('resources.edit', [$resource->id]) }}" class='btn btn-default btn-xs'>
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
