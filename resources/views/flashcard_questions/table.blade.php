<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Question</th>
                <th>Explanation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($flashcardQuestions as $flashcardQuestion)
            <tr>
                <td>{{ $flashcardQuestion->question }}</td>
                <td>{{ $flashcardQuestion->explanation }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardQuestions.destroy', $flashcardQuestion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardQuestions.show', [$flashcardQuestion->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('flashcardQuestions.edit', [$flashcardQuestion->id]) }}" class='btn btn-default btn-xs'>
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
