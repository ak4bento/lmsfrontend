<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>User Id</th>
                <th>Flashcard Questions Id</th>
                <th>Group</th>
                <th>Choice</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flashcardAnswers as $flashcardAnswer)
            <tr>
                <td>{{ $flashcardAnswer->user_id }}</td>
                <td>{{ $flashcardAnswer->flashcard_questions_id }}</td>
                <td>{{ $flashcardAnswer->group }}</td>
                <td>{{ $flashcardAnswer->choice }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardAnswers.destroy', $flashcardAnswer->id], 'method' =>
                    'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardAnswers.show', [$flashcardAnswer->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('flashcardAnswers.edit', [$flashcardAnswer->id]) }}"
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