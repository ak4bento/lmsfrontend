<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($teachingPeriods as $teachingPeriod)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $teachingPeriod->name }}</td>
                    <td>{{ $teachingPeriod->start_at }}</td>
                    <td>{{ $teachingPeriod->end_at }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['teachingPeriods.destroy', $teachingPeriod->id], 'method' => 'delete']) !!}
                        <a href="{{ route('teachingPeriods.show', [$teachingPeriod->id]) }}"
                            class='btn btn-info btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('teachingPeriods.edit', [$teachingPeriod->id]) }}"
                            class='btn btn-primary btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
