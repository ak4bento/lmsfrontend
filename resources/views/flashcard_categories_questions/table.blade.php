<div class="table-responsive">
    <table class="table" id="flashcardCategoriesQuestions-table">
        <thead>
            <tr>
                <th>Flashcard Questions Id</th>
        <th>Flashcard Categories Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($flashcardCategoriesQuestions as $flashcardCategoriesQuestion)
            <tr>
                <td>{{ $flashcardCategoriesQuestion->flashcard_questions_id }}</td>
            <td>{{ $flashcardCategoriesQuestion->flashcard_categories_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardCategoriesQuestions.destroy', $flashcardCategoriesQuestion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardCategoriesQuestions.show', [$flashcardCategoriesQuestion->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('flashcardCategoriesQuestions.edit', [$flashcardCategoriesQuestion->id]) }}" class='btn btn-default btn-xs'>
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
