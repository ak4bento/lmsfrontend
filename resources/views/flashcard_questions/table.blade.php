<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Flashcard Categories Id</th>
                <th>Question</th>
                <th>Images</th>
                <th>Explanation</th>
                <th>Images Explanation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flashcardQuestions as $flashcardQuestion)
            <tr>
                <td>{{ $flashcardQuestion->flashcard_categories_id }}</td>
                <td>{{ $flashcardQuestion->question }}</td>
                <td>{{ $flashcardQuestion->images }}</td>
                <td>{{ $flashcardQuestion->explanation }}</td>
                <td>{{ $flashcardQuestion->images_explanation }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardQuestions.destroy', $flashcardQuestion->id], 'method' =>
                    'delete']) !!}
                    {{-- <a href="{{ route('flashcardQuestions.show', [$flashcardQuestion->id]) }}"
                    class='btn btn-default btn-xs'>
                    <i class="far fa-eye"></i>
                    </a> --}}
                    <a href="{{ route('flashcardQuestions.edit', [$flashcardQuestion->id]) }}"
                        class='btn btn-primary btn-sm'>
                        <i class="far fa-edit"></i>
                    </a>
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn
                    btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>