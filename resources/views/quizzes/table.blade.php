<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Pertanyaan</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($quizzes as $quizzes)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $quizzes->title }}</td>
                    <td>{{ $quizzes->description }}</td>
                    <td>{{ App\Models\QuestionQuizzes::where('quizzes_id', $quizzes->id)->count() }}</td>
                    <td>{{ App\Models\User::find($quizzes->created_by)->name }}</td>
                    <td width="150">
                        {!! Form::open(['route' => ['quizzes.destroy', $quizzes->id], 'method' => 'delete']) !!}
                        <a href="{{ route('quizzes.show', [$quizzes->id]) }}"
                            class='btn btn-block btn-primary btn-sm'>
                            <i class="far fa-plus-square"></i> Tambah Pertanyaan
                        </a>
                        <div class='btn-group btn-block'>
                            <a href="{{ route('quizzes.edit', [$quizzes->id]) }}" class='btn btn-success btn-sm'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
