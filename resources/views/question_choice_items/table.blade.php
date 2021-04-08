<div class="table-responsive">
    <table class="table" id="questionChoiceItems-table">
        <thead>
            <tr>
                <th>Question Id</th>
        <th>Choice Text</th>
        <th>Is Correct</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questionChoiceItems as $questionChoiceItem)
            <tr>
                <td>{{ $questionChoiceItem->question_id }}</td>
            <td>{{ $questionChoiceItem->choice_text }}</td>
            <td>{{ $questionChoiceItem->is_correct }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['questionChoiceItems.destroy', $questionChoiceItem->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('questionChoiceItems.show', [$questionChoiceItem->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('questionChoiceItems.edit', [$questionChoiceItem->id]) }}" class='btn btn-default btn-xs'>
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
