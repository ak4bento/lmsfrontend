@extends('frontend.layouts.app') @section('content')
    <div class="container">
        {{-- <section class="content-header py-5" style="background-color: #1967d2;border-radius: 10px;margin-bottom:10px">
            <div class="row text-white ">
                <div class="col-lg-10 ">
                    <h1 class="display-4">
                        <strong>
                            {{ $classrooms->title }}
                        </strong>
                    </h1>
                    <p class="lead">
                        {{ $classrooms->subject }}
                    </p>
                </div>
                <div class="col-lg-2" style="background:#C60012;height:70px;">
                </div>
            </div>
        </section> --}}
        <div class="jumbotron jumbotron-fluid text-white" style="background-color: #1967d2;border-radius: 10px ;">
            <div class="container">
                <h1 class="display-4">
                    <strong>
                        {{ $classrooms->title }}
                    </strong>
                </h1>
                <p class="lead">
                    {{ $classrooms->subject }}
                </p>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="fixme">
                                <div class="card">
                                    <div class="dropdown ">
                                        <a class="btn btn-primary btn-block py-2" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-plus primary"></i> &nbsp;Buat Aktifitas
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item py-2"
                                                href="{{ route('createAssignment', $classrooms->slug) }}">
                                                <i class="fa fa-book"> </i>&nbsp; Tugas
                                            </a>
                                            <a class="dropdown-item py-2"
                                                href="{{ route('createResources', $classrooms->slug) }}">
                                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                                                &nbsp; Materi </a>
                                            <a class="dropdown-item py-2"
                                                href="{{ route('createQuezzes', $classrooms->slug) }}">
                                                <i class="fa fa-book"></i>&nbsp; Kuis </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="dropdown ">
                                        <a class="btn btn-primary btn-block py-2" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            &nbsp;Aktifitas Owner
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item py-2"
                                                href="{{ route('createAssignment', $classrooms->slug) }}">
                                                <i class="fa fa-plus"></i> &nbsp; Tambah Pengajar
                                            </a>
                                            <a class="dropdown-item py-2"
                                                href="{{ route('editClassroom', $classrooms->slug) }}">
                                                <i class="far fa-edit"></i>
                                                &nbsp; Edit Kelas </a>
                                            <a class="dropdown-item py-2"
                                                href="{{ route('createQuezzes', $classrooms->slug) }}">
                                                <i class="fa fa-trash"></i> &nbsp; Hapus Kelas </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card ">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Deskripsi
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <dl>
                                            {{ $classrooms->description }}
                                        </dl>
                                        @if ($classroomUsers < 1)
                                            <a class="btn btn-primary btn-block join-class"
                                                data-url="{{ route('joinClassroom', $classrooms->slug) }}">
                                                Gabung ke Dalam kelas
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            {{-- <div class="card card-widget">
                                <div class="card-body">

                                </div>
                            </div> --}}
                            @foreach ($teachables as $teachable)
                                <div class="card">
                                    {{-- onclick="location.href='asdhasjkh';" style="cursor: pointer;" --}}
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            {{-- <div class="col col-lg-1 col-md-1 col-sm-1">
                                                <img src="{{ asset('study.png') }}" style="max-width: 50px"
                                                    class="img-fluid">
                                            </div> --}}
                                            <div class="col col-lg-10 col-md-10 col-sm-10">
                                                <div class="row">
                                                    @if ($teachable->teachable_type == 'quiz')
                                                        <a data-toggle="tooltip" data-placement="top" title="Lihat Kuis"
                                                            style="font-weight: bold;"
                                                            href="{{ route('class.work.detail', ['quizzes', $teachable->teachable_id]) }}">
                                                            {{ App\Models\Quizzes::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                        </a>
                                                    @elseif ($teachable->teachable_type == 'resource')
                                                        <a data-toggle="tooltip" data-placement="top" title="Lihat Materi"
                                                            style="font-weight: bold;"
                                                            href="{{ route('class.work.detail', ['resources', $teachable->teachable_id]) }}">
                                                            {{ App\Models\Resource::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                        </a>
                                                    @elseif ($teachable->teachable_type == 'assignment')
                                                        <a data-toggle="tooltip" data-placement="top" title="Lihat Tugas"
                                                            style="font-weight: bold;"
                                                            href="{{ route('class.work.detail', ['assignments', $teachable->teachable_id]) }}">
                                                            {{ App\Models\Assignment::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <span style="color: grey;font-size:10px"> Diposting
                                                        {{ date('d-m-Y H:i', strtotime($teachable->updated_at)) }}</span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-2 col-md-2 col-sm-2">
                                                <div class="dropdown">
                                                    <a class="btn float-right" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v primary"></i>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        @if ($teachable->teachable_type == 'quiz')
                                                            <a href="{{ route('showAllQuestion', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                                class="dropdown-item">Lihat Soal </a>
                                                            <a href="{{ route('editQuezzes', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                                class="dropdown-item">Edit </a>
                                                            <a class="dropdown-item btn delete"
                                                                data-url="{{ route('destroyQuezzes', $teachable->teachable_id) }}">
                                                                Hapus</a>
                                                        @elseif ($teachable->teachable_type == 'resource')
                                                            <a href="{{ route('editResources', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                                class="dropdown-item">Edit </a>
                                                            <a class="dropdown-item btn delete"
                                                                data-url="{{ route('destroyResources', $teachable->teachable_id) }}">
                                                                Hapus</a>
                                                        @elseif ($teachable->teachable_type == 'assignment')
                                                            <a href="{{ route('editAssignment', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                                class="dropdown-item">Edit </a>
                                                            <a class="dropdown-item btn delete"
                                                                data-url="{{ route('destroyAssignment', $teachable->teachable_id) }}">
                                                                Hapus</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('page_scripts')
    <script>
        $(".join-class").click(function(e) {
            e.preventDefault();
            let url = $(this).data('url');

            console.log('url', url);
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Tekan Tombol "Gabung" Jika Anda Ingin Bergabung Dikelas ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#174ea6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Gabung',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });

    </script>
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
