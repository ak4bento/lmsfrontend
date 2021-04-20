<div class="table-responsive">
    <table class="table" id="quizAttempts-table">
        <thead>
            <tr>
                <th>Teachable User Id</th>
        <th>Attempt</th>
        <th>Questions</th>
        <th>Answers</th>
        <th>Completed At</th>
        <th>Grading Method</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($quizAttempts as $quizAttempt)
            <tr>
                <td>{{ $quizAttempt->teachable_user_id }}</td>
            <td>{{ $quizAttempt->attempt }}</td>
            <td>{{ $quizAttempt->questions }}</td>
            <td>{{ $quizAttempt->answers }}</td>
            <td>{{ $quizAttempt->completed_at }}</td>
            <td>{{ $quizAttempt->grading_method }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['quizAttempts.destroy', $quizAttempt->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('quizAttempts.show', [$quizAttempt->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('quizAttempts.edit', [$quizAttempt->id]) }}" class='btn btn-default btn-xs'>
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
