<div class="table-responsive">
    <table class="table" id="teachables-table">
        <thead>
            <tr>
                <th>Teachable Id</th>
                <th>Teachable Type</th>
                <th>Classroom Id</th>
                <th>Available At</th>
                <th>Expires At</th>
                <th>Final Grade Weight</th>
                <th>Max Attempts Count</th>
                <th>Order</th>
                <th>Pass Threshold</th>
                <th>Created By</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachables as $teachable)
                <tr>
                    <td>{{ $teachable->teachable_id }}</td>
                    <td>{{ $teachable->teachable_type }}</td>
                    <td>{{ $teachable->classroom_id }}</td>
                    <td>{{ $teachable->available_at }}</td>
                    <td>{{ $teachable->expires_at }}</td>
                    <td>{{ $teachable->final_grade_weight }}</td>
                    <td>{{ $teachable->max_attempts_count }}</td>
                    <td>{{ $teachable->order }}</td>
                    <td>{{ $teachable->pass_threshold }}</td>
                    <td>{{ $teachable->created_by }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['teachables.destroy', $teachable->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('teachables.show', [$teachable->id]) }}"
                                class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('teachables.edit', [$teachable->id]) }}"
                                class='btn btn-default btn-xs'>
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
