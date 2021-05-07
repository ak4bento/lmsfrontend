<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
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
            @php
            $no = 1;
            @endphp
            @foreach ($classrooms as $classroom)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ App\Models\Subject::find($classroom->subject_id)->title }}</td>
                <td>{{ App\Models\TeachingPeriod::find($classroom->teaching_period_id)->name }}</td>
                <td>{{ $classroom->slug }}</td>
                <td>{{ $classroom->code }}</td>
                <td>{{ $classroom->title }}</td>
                <td>{{ $classroom->description }}</td>
                <td>{{ $classroom->start_at }} - {{ $classroom->end_at }}</td>
                <td>{{ App\Models\User::find($classroom->created_by)->name }}</td>
                <td width="120">
                    <a href="{{ route('classrooms.show', [$classroom->id]) }}" class='btn btn-info btn-sm'>
                        <i class="far fa-eye"></i>
                    </a>
                    <a href="{{ route('classrooms.edit', [$classroom->id]) }}" class='btn btn-primary btn-sm'>
                        <i class="far fa-edit"></i>
                    </a>
                    <button class="btn btn-danger btn-sm delete" id="delete" data-id="{{ $classroom->id }}"
                        data-url="{{ url('admin/classrooms/destroy') }}/{{ $classroom->id }}">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>