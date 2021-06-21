<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Parent Id</th>
                <th>Second Parent Id</th>
                <th>Third Parent Id</th>
                <th>Level</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flashcardCategories as $flashcardCategories)
            <tr>
                <td>{{ $flashcardCategories->parent_id }}</td>
                <td>{{ $flashcardCategories->second_parent_id }}</td>
                <td>{{ $flashcardCategories->third_parent_id }}</td>
                <td>{{ $flashcardCategories->level }}</td>
                <td>{{ $flashcardCategories->category }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardCategories.destroy', $flashcardCategories->id], 'method' =>
                    'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardCategories.show', [$flashcardCategories->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('flashcardCategories.edit', [$flashcardCategories->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>