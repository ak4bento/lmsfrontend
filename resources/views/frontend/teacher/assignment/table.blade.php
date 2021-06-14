<div class="table-responsive">
    <table id="example2" class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>File Tugas</th>
                <th>Tanggal</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($media as $data)
            <tr>
                <td width="5%">{{ $no++ }}</td>
                <td>
                    @foreach (json_decode($data->custom_properties) as $item)
                    {{ App\Models\User::find($item)->name }}
                    @endforeach
                </td>
                <td>
                    <a target="_blank" href="{{ asset('files') }}/{{ $data->file_name }}">
                        {{ $data->name }}
                    </a>
                </td>
                <td>
                    {{ $data->created_at }}
                </td>
                <td width="9%">

                    @if (App\Models\Grade::where('gradeable_id', $data->id)->where('gradeable_type', 'media')->first()
                    != null)
                    <button type="button"
                        onclick="gradeBtnClick({{ $data->id }},{{ $data->media_id }},{{ App\Models\Grade::where('gradeable_id', $data->id)->where('gradeable_type', 'media')->first()->grade }})"
                        data-grade="{{ App\Models\Grade::where('gradeable_id', $data->id)->where('gradeable_type', 'media')->first()->grade }}"
                        data-id="{{ $data->id }}" data-media_id="{{ $data->media_id }}" id="button"
                        data-togglebtn="tooltip" data-placement="top" title="Beri Nilai" class="btn btn-primary btn-sm"
                        data-dismiss="modal" data-toggle="modal" data-target="#exampleModalCenter">
                        {{ App\Models\Grade::where('gradeable_id', $data->id)->where('gradeable_type', 'media')->first()->grade }}
                    </button>

                    @else
                    <button
                        onclick="gradeBtnClick({{ $data->id }},{{ $data->media_id }},{{ App\Models\Grade::where('gradeable_id', $data->id)->where('gradeable_type', 'media')->first()->grade  ?? 0}})"
                        type="button" data-grade="0" data-id="{{ $data->id }}" data-media_id="{{ $data->media_id }}"
                        id="button" data-togglebtn="tooltip" data-placement="top" title="Beri Nilai"
                        class="btn btn-danger btn-sm" data-dismiss="modal" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Beri Nilai
                    </button>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <span style="font-size: 20px" id="exampleModalLongTitle">
                        Nilai
                    </span>

                </div>
            </div>
            <form action="{{ route('gradeStore', $classrooms->slug) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="media_id" name="media_id">
                        <input type="number" placeholder="80" name="grade" id="grade" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" data-togglebtn="tooltip"
                        data-placement="top" title="Tutup"><i class="fas fa-times"></i></button>
                    <button type="submit" data-togglebtn="tooltip" data-placement="top" title="Simpan"
                        class="btn btn-sm btn-primary"><i class="far fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('page_scripts')
<script>
    $(document).ready(function() {
            $('[data-togglebtn="tooltip"]').tooltip();
        });

        function gradeBtnClick(id, media_id, grade){
            console.log('ini data ku onclick : ', id);
            $("#id").val(id);
            $("#media_id").val(media_id);
            $("#grade").val(grade);
        }

        // $("#button").click(function(e) {
        //     e.preventDefault();
        //     let id = $(this).data('id');
        //     let media_id = $(this).data('media_id');
        //     let grade = $(this).data('grade');
        //     console.log('ini data ku :', id);
        //     $("#id").val(id);
        //     $("#media_id").val(media_id);
        //     $("#grade").val(grade);
        // });

</script>
@endpush