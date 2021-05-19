<div class="table-responsive">
    <table class="table" id="flashcardSubjects-table">
        <thead>
            <tr>
                <th>Subject</th>
        <th>Subject Type</th>
        <th>Reference</th>
        <th>External Link</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($flashcardSubjects as $flashcardSubject)
            <tr>
                <td>{{ $flashcardSubject->subject }}</td>
            <td>{{ $flashcardSubject->subject_type }}</td>
            <td>{{ $flashcardSubject->reference }}</td>
            <td>{{ $flashcardSubject->external_link }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['flashcardSubjects.destroy', $flashcardSubject->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('flashcardSubjects.show', [$flashcardSubject->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('flashcardSubjects.edit', [$flashcardSubject->id]) }}" class='btn btn-default btn-xs'>
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
