<div class="table-responsive">
    <table class="table" id="flashcardCategories-table">
        <thead>
            <tr>
                <th>Parent Id</th>
        <th>Category</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($flashcardCategories as $flashcardCategories)
            <tr>
                <td>{{ $flashcardCategories->parent_id }}</td>
            <td>{{ $flashcardCategories->category }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardCategories.destroy', $flashcardCategories->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardCategories.show', [$flashcardCategories->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('flashcardCategories.edit', [$flashcardCategories->id]) }}" class='btn btn-default btn-xs'>
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
