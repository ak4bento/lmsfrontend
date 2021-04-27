<div class="table-responsive">
    <table class="table" id="questionQuizzes-table">
        <thead>
            <tr>
                <th>Quizzes Id</th>
        <th>Question Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questionQuizzes as $questionQuizzes)
            <tr>
                <td>{{ $questionQuizzes->quizzes_id }}</td>
            <td>{{ $questionQuizzes->question_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['questionQuizzes.destroy', $questionQuizzes->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('questionQuizzes.show', [$questionQuizzes->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('questionQuizzes.edit', [$questionQuizzes->id]) }}" class='btn btn-default btn-xs'>
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
