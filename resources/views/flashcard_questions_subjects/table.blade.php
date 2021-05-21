<div class="table-responsive">
    <table class="table" id="flashcardQuestionsSubjects-table">
        <thead>
            <tr>
                <th>Flashcard Questions Id</th>
        <th>Flashcard Subjects Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($flashcardQuestionsSubjects as $flashcardQuestionsSubject)
            <tr>
                <td>{{ $flashcardQuestionsSubject->flashcard_questions_id }}</td>
            <td>{{ $flashcardQuestionsSubject->flashcard_subjects_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardQuestionsSubjects.destroy', $flashcardQuestionsSubject->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardQuestionsSubjects.show', [$flashcardQuestionsSubject->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('flashcardQuestionsSubjects.edit', [$flashcardQuestionsSubject->id]) }}" class='btn btn-default btn-xs'>
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
