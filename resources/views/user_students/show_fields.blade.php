<div class="table-responsive col-sm-12">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Kelas</th>
                <th>Kelas</th>
                <th>Kode Matakuliah</th>
                <th>Matakuliah</th>
                <th>Jam</th>
                <th>Tahun Ajar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($classroom_users as $classroom_user)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $classroom_user->code }}</td>
                    <td>{{ $classroom_user->title }}</td>
                    <td>{{ App\Models\Subject::find($classroom_user->subject_id)->code }}</td>
                    <td>{{ App\Models\Subject::find($classroom_user->subject_id)->title }}</td>
                    <td>{{ $classroom_user->start_at }} - {{ $classroom_user->end_at }}</td>
                    <td>{{ App\Models\TeachingPeriod::find($classroom_user->teaching_period_id)->name }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['classroomUsers.destroy', $userStudent->id], 'method' => 'delete']) !!}
                        <a href="{{ route('classroomUsers.show', [$classroom_user->classroom_user_id]) }}"
                            class='btn btn-default btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('classroomUsers.edit', [$classroom_user->classroom_user_id]) }}"
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
