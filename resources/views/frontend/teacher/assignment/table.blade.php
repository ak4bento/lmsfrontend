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
                    <td>{{ $data->custom_properties }} </td>
                    <td>
                        <a target="_blank" href="{{ asset('files') }}/{{ $data->file_name }}">
                            {{ $data->name }}
                        </a>
                    </td>
                    <td>
                        {{ $data->created_at }}
                    </td>
                    <td width="9%">
                        <button type="button" data-togglebtn="tooltip" data-placement="top" title="Beri Nilai"
                            class="btn btn-primary btn-sm" data-dismiss="modal" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            Beri Nilai
                        </button>
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
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    <input type="number" placeholder="80" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" data-togglebtn="tooltip"
                    data-placement="top" title="Tutup"><i class="fas fa-times"></i></button>
                <button type="submit" data-togglebtn="tooltip" data-placement="top" title="Simpan"
                    class="btn btn-sm btn-primary"><i class="far fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('[data-togglebtn="tooltip"]').tooltip();
        });

    </script>
@endpush
