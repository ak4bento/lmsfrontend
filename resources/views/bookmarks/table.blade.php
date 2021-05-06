<div class="table-responsive">
    <table class="table" id="bookmarks-table">
        <thead>
            <tr>
                <th>Teachable Id</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bookmarks as $bookmark)
            <tr>
                <td>{{ $bookmark->teachable_id }}</td>
            <td>{{ $bookmark->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['bookmarks.destroy', $bookmark->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('bookmarks.show', [$bookmark->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('bookmarks.edit', [$bookmark->id]) }}" class='btn btn-default btn-xs'>
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
