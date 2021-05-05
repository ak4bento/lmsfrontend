<div class="table-responsive">
    <table id="example2" class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>  
                <th>Tanggal</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($quiz_attempts as $quiz_attempt)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        @foreach (json_decode($quiz_attempt->answers) as $item)
                            {{ App\Models\User::find($item->data->user_id)->name }}
                        @endforeach
                    </td>  
                    <td >
                        {{ $quiz_attempt->created_at }}
                    </td>
                    <td>
                        {{ App\Models\Grade::where('gradeable_id', $quiz_attempt->id)->where('gradeable_type', 'quiz')->first()->grade }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
