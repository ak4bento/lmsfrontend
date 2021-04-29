<div class="table-responsive">
    <table class="table" id="grades-table">
        <thead>
            <tr>
                <th>Gradeable Id</th>
        <th>Gradeable Type</th>
        <th>Grading Method</th>
        <th>Comments</th>
        <th>Grade</th>
        <th>Completed At</th>
        <th>Graded By</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->gradeable_id }}</td>
            <td>{{ $grade->gradeable_type }}</td>
            <td>{{ $grade->grading_method }}</td>
            <td>{{ $grade->comments }}</td>
            <td>{{ $grade->grade }}</td>
            <td>{{ $grade->completed_at }}</td>
            <td>{{ $grade->graded_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['grades.destroy', $grade->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('grades.show', [$grade->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('grades.edit', [$grade->id]) }}" class='btn btn-default btn-xs'>
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
