<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Periode Mengajar</th>
                <th>Slug</th>
                <th>Kode Kelas</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Jam</th> 
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($classrooms as $classroom)
            <tr>
                <td>{{ App\Models\Subject::find($classroom->subject_id)->title  }}</td>
                <td>{{ App\Models\TeachingPeriod::find($classroom->teaching_period_id)->name }}</td>
                <td>{{ $classroom->slug }}</td>
                <td>{{ $classroom->code }}</td>
                <td>{{ $classroom->title }}</td>
                <td>{{ $classroom->description }}</td>
                <td>{{ $classroom->start_at }} - {{ $classroom->end_at }}</td>
                <td>{{ App\Models\User::find($classroom->created_by)->name  }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['classrooms.destroy', $classroom->id], 'method' => 'delete']) !!}
                        <a href="{{ route('classrooms.show', [$classroom->id]) }}" class='btn btn-default btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('classrooms.edit', [$classroom->id]) }}" class='btn btn-primary btn-sm'>
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
