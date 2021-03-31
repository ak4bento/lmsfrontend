<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Start At</th>
                <th>End At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachingPeriods as $teachingPeriod)
            <tr>
                <td>{{ $teachingPeriod->name }}</td>
            <td>{{ $teachingPeriod->start_at }}</td>
            <td>{{ $teachingPeriod->end_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['teachingPeriods.destroy', $teachingPeriod->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('teachingPeriods.show', [$teachingPeriod->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('teachingPeriods.edit', [$teachingPeriod->id]) }}" class='btn btn-default btn-xs'>
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
