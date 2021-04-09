<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Slug</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Dibuat Oleh</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $subject->slug }}</td>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->title }}</td>
                    <td>{{ $subject->description }}</td>
                    <td>{{ $subject->default_category_id }}</td>
                    <td>{{ App\Models\User::find($subject->created_by)->name }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['subjects.destroy', $subject->id], 'method' => 'delete']) !!}
                        <a href="{{ route('subjects.show', [$subject->id]) }}" class='btn btn-info btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('subjects.edit', [$subject->id]) }}" class='btn btn-primary btn-sm'>
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
