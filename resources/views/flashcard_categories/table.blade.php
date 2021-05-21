<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Level</th>
                <th>Parent</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($flashcardCategories as $flashcardCategories)
            <tr>
                <td>Level Ketegori {{ $flashcardCategories->level }}</td>
                <td>{{ App\Models\FlashcardCategories::find($flashcardCategories->parent_id)->category ?? 'Kategori Utama' }}</td>
                <td>{{ $flashcardCategories->category }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardCategories.destroy', $flashcardCategories->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardCategories.edit', [$flashcardCategories->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i> Ubah
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i> Hapus', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
