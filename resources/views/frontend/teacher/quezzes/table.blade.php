<div class="table-responsive">
    <table id="example2" class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe Soal</th>  
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($quiz_attempts as $quiz_attempt)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $quiz_attempt->questions }}</td>  
                    <td width="120">

                        <a href="{{ route('editQuestion', ['slugClass' => $classroom->slug, 'slugQuiz' => $quizzes->id, 'id' => $quiz_attempt->id]) }}"
                            class='btn btn-primary btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm delete" id="delete" data-id="{{ $quiz_attempt->id }}"
                            data-url="{{ route('destroyQuestion', ['slug' => $classroom->slug, 'quiz_id' => $quizzes->id, 'id' => $quiz_attempt->id]) }}">
                            <i class="far fa-trash-alt"></i>
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
