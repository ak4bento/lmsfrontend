<div class="table-responsive">
    <table id="example2" class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe Soal</th>
                {{-- <th>Jawaban</th> --}}
                <th>Pertanyaan</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($questions as $question)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $question->question_type }}</td>
                    {{-- <td>{{ $question->answers }}</td> --}}
                    <td>{!! $question->content !!}</td>
                    <td>{{ App\Models\User::find($question->created_by)->name }} </td>
                    <td width="120">

                        <a href="{{ route('editQuestion', ['slugClass' => $classroom->slug, 'slugQuiz' => $quizzes->id, 'id' => $question->id]) }}"
                            class='btn btn-primary btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm delete" data-id="{{ $question->id }}"
                            data-url="{{ route('destroyQuestion', ['slug' => $classroom->slug, 'quiz_id' => $quizzes->id, 'id' => $question->id]) }}">
                            <i class="far fa-trash-alt"></i>
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('page_scripts')
    <script>
        
    $(".delete").click(function(e) {
        e.preventDefault();
        let url = $(this).data('url');

        console.log('url 1', url);
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1b5cb8',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        })
    });

    </script>
@endpush