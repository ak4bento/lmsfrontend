@if ($classroomUsers > 0)
    @if ($teachable->teachable_type == 'quiz')
        <a href="{{ url('/class-work-detail') }}/{{ 'quizzes' }}/{{ $teachable->teachable_id }}"
            class="btn btn-primary btn-sm float-right" data-html="true" data-toggle="tooltip"
            title="<h6>Lihat Kuis</h6>"><i class="far fa-eye"></i>
        </a>
    @elseif ($teachable->teachable_type == 'resource')
        {{-- resource --}}
        {{-- hapus --}}
        <a data-url="{{ route('destroyResources', $teachable->teachable_id) }}"
            class="btn btn-danger btn-sm float-right delete" data-html="true" style="margin-left: 2px"
            data-toggle="tooltip" title="<h6>Hapus Materi</h6>"><i class="fa fa-trash"></i>
        </a>
        {{-- edit --}}
        <a href="{{ route('editResources', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
            class="btn btn-success btn-sm float-right" style="margin-left: 2px" data-toggle="tooltip" data-html="true"
            title="<h6>Edit Materi</h6>"><i class="far fa-edit"></i>
        </a>

        {{-- lihat --}}
        <a href="{{ url('/class-work-detail') }}/{{ 'resources' }}/{{ $teachable->teachable_id }}"
            class="btn btn-primary btn-sm float-right" data-html="true" data-toggle="tooltip"
            title="<h6>Lihat Materi</h6>"><i class="far fa-eye"></i>
        </a>
    @elseif ($teachable->teachable_type == 'assignment')
        {{-- assignment --}}
        {{-- hapus --}}
        <a data-url="{{ route('destroyAssignment', $teachable->teachable_id) }}"
            class="btn btn-danger btn-sm float-right delete" data-html="true" style="margin-left: 2px"
            data-toggle="tooltip" title="<h6>Hapus Tugas</h6>"><i class="fa fa-trash"></i>
        </a>

        {{-- edit --}}
        <a href="{{ route('editAssignment', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
            class="btn btn-success btn-sm float-right" style="margin-left: 2px" data-toggle="tooltip" data-html="true"
            title="<h6>Edit Tugas</h6>"><i class="far fa-edit"></i>
        </a>

        {{-- lihat --}}
        <a href="{{ url('/class-work-detail') }}/{{ 'assignments' }}/{{ $teachable->teachable_id }}"
            class="btn btn-primary btn-sm float-right" data-html="true" data-toggle="tooltip"
            title="<h6>Lihat Tugas</h6>"><i class="far fa-eye"></i>
        </a>
        {{-- end assignment --}}
    @endif
@else
    <a class="btn btn-primary btn-sm float-right not_allowed" data-html="true" data-toggle="tooltip"
        title="<h6>Lihat</h6>"><i class="far fa-eye"></i>
    </a>
@endif
@push('page_scripts')
    <script>
        $(".delete").click(function(e) {
            e.preventDefault();
            let url = $(this).data('url');

            console.log('url', url);
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#174ea6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });
        $(".not_allowed").click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Tidak di Izinkan',
                text: "Anda tidak terdaftar atau  tidak diizankan membuka materi ini!",
                icon: 'warning',
                confirmButtonColor: '#174ea6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tutup'
            })
        });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endpush
