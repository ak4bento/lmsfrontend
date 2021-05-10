@extends('frontend.layouts.app') @section('content')
    @push('page_css')
        <style>
            .ion-medium {
                font-size: 16px;
            }

            #card {
                border-radius: 4px;
                background: #fff;
                box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
                transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
                /* cursor: pointer; */
            }

            #card:hover {
                background: #f4f7fc;
                box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
            }

            .bookmark-active{
                color:#1b5cb8;
                font-size:22px;
            }

            .bookmark-default{
                color:rgb(190, 190, 190);
                font-size:22px;
            }
            .bookmark-clik:hover{
                transform: scale(1.20);
                cursor: pointer;
                color:#3b72ca;
            }

            .dropdown-hover{
                cursor: pointer;
            }

        </style>
    @endpush
    <div class="container">
        <div class="jumbotron jumbotron-fluid text-white p-5" style="background-color: #1b5cb8;border-radius: 10px ;">
            <div class="container">
                <div class="row">
                    <a style="font-size: 2.5em">{{ $classrooms->title }} </a>
                </div>
                <div class="row">
                    <a style="font-size: 1.5em">{{ $classrooms->subject }}</a>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="fixme">
                                @hasanyrole('teacher')
                                @if ($classroomUsersCount > 0)
                                    <div class="card">
                                        <div class="dropdown ">
                                            <a class="btn btn-primary btn-block py-2" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-plus"></i> &nbsp;Buat Aktifitas
                                            </a>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item py-2"
                                                    href="{{ route('createAssignment', $classrooms->slug) }}">
                                                    <ion-icon name="document-text-outline" class="ion-medium"></ion-icon>
                                                    &nbsp;
                                                    Tugas
                                                </a>
                                                <a class="dropdown-item py-2"
                                                    href="{{ route('createResources', $classrooms->slug) }}">
                                                    <ion-icon name="book-outline" class="ion-medium"></ion-icon> &nbsp;
                                                    Materi
                                                </a>
                                                <a class="dropdown-item py-2"
                                                    href="{{ route('createQuezzes', $classrooms->slug) }}">
                                                    <ion-icon name="bookmarks-outline" class="ion-medium"></ion-icon>&nbsp;
                                                    Kuis
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @endhasanyrole

                                @hasanyrole('owner')
                                @if ($classroomUsersCount > 0)
                                    {{-- owner --}}
                                    <div class="card">
                                        <div class="dropdown ">
                                            <a class="btn btn-primary btn-block py-2" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fas fa-cog"></i>
                                                &nbsp;Pengaturan
                                            </a>
                                            <div class="dropdown-menu">
                                                <a type="button" class=" dropdown-item py-2" data-toggle="modal"
                                                    data-target="#exampleModalCenter">
                                                    <ion-icon name="person" class="ion-medium"></ion-icon>
                                                    &nbsp;Pengguna Kelas
                                                </a>
                                                <a class="dropdown-item py-2"
                                                    href="{{ route('editClassroom', $classrooms->slug) }}">
                                                    <i class="far fa-edit"></i>
                                                    &nbsp; Edit Kelas </a>
                                                <a class="dropdown-item py-2 delete" href=""
                                                    data-url="{{ route('destroyClassroom', $classrooms->slug) }}">
                                                    <i class="fa fa-trash"></i> &nbsp; Hapus Kelas </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="container-fluid">
                                                        <span style="font-size: 20px" id="exampleModalLongTitle">
                                                            Pengajar
                                                        </span>
                                                        <button type="button" data-togglebtn="tooltip" data-placement="top"
                                                            title="Tambah Pengajar"
                                                            class="btn btn-primary btn-sm float-right" data-dismiss="modal"
                                                            data-toggle="modal" data-target="#exampleModalCenter1">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        @foreach ($classroomTeacher as $data)
                                                            <div class="row">
                                                                <div class="card py-2 col-12 ">
                                                                    <div class=" row justify-content-between ">
                                                                        <div class=" col-10">
                                                                            <span>
                                                                                {{ $data->username }}
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <a data-toggle="tooltip" data-placement="top"
                                                                                title="Hapus Pengajar"
                                                                                class="btn btn-danger btn-sm float-right delete"
                                                                                data-url="{{ route('destroyTeacher', ['slug' => $classrooms->slug, 'id' => $data->user_id]) }}">
                                                                                <i class="far fa-trash-alt"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="container-fluid">

                                                        <button type="button" class="btn btn-warning btn-sm float-right"
                                                            data-togglebtn="tooltip" data-placement="top" title="Tutup"
                                                            data-dismiss="modal"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('storeTeacher', $classrooms->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            Tambah Pengajar
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group col-sm-12">
                                                            <select name="user_id" class="form-control select2" id="user_id"
                                                                style="width: 100%;">
                                                                @foreach ($studentTeacher as $data)
                                                                    <option {{ $data->id }}
                                                                        value="{{ $data->id }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-dismiss="modal" data-togglebtn="tooltip"
                                                            data-placement="top" title="Tutup"
                                                            data-target="#exampleModalCenter" data-toggle="modal"><i
                                                                class="fas fa-times"></i></button>
                                                        <button type="submit" data-togglebtn="tooltip" data-placement="top"
                                                            title="Simpan" class="btn btn-sm btn-primary"><i
                                                                class="far fa-save"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @endhasanyrole
                                {{-- end owner --}}

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
                                        @hasanyrole('student')
                                        @if ($classroomUsersCount < 1)
                                            <a class="btn btn-primary btn-block join-class"
                                                data-url="{{ route('joinClassroom', $classrooms->slug) }}">
                                                Gabung ke Dalam kelas
                                            </a>
                                        @endif
                                        @endhasanyrole
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            @foreach ($teachables as $teachable)
                                <div class="card" id="card">
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

                                                            @if (App\Models\Progress::where('progress_type', 'quizzes')->where('progress_id', $teachable->teachable_id)->where('class_id', $classrooms->id)->where('user_id', Auth::user()->id)->count() > 0)
                                                            <i class="fas fa-check-circle text-success"></i>
                                                            @endif

                                                            {{ App\Models\Quizzes::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                        </a>
                                                    @elseif ($teachable->teachable_type == 'resource')
                                                        <a data-toggle="tooltip" data-placement="top" title="Lihat Materi"
                                                            style="font-weight: bold;"
                                                            href="{{ route('class.work.detail', ['resources', $teachable->teachable_id]) }}">

                                                            @if (App\Models\Progress::where('progress_type', 'resources')->where('progress_id', $teachable->teachable_id)->where('class_id', $classrooms->id)->where('user_id', Auth::user()->id)->count() > 0)
                                                            <i class="fas fa-check-circle text-success"></i>
                                                            @endif

                                                            {{ App\Models\Resource::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                        </a>
                                                    @elseif ($teachable->teachable_type == 'assignment')
                                                        <a data-toggle="tooltip" data-placement="top" title="Lihat Tugas"
                                                            style="font-weight: bold;"
                                                            href="{{ route('class.work.detail', ['assignments', $teachable->teachable_id]) }}">

                                                            @if (App\Models\Progress::where('progress_type', 'assignments')->where('progress_id', $teachable->teachable_id)->where('class_id', $classrooms->id)->where('user_id', Auth::user()->id)->count() > 0)
                                                            <i class="fas fa-check-circle text-success"></i>
                                                            @endif

                                                            {{ App\Models\Assignment::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <span style="color: grey;font-size:10px"> Diposting
                                                        {{ date('d-m-Y H:iA', strtotime($teachable->updated_at)) }}</span>
                                                </div>
                                            </div>
                                            <div class="col col-lg-2 col-md-2 col-sm-2">
                                                @hasanyrole('teacher')
                                                @if ($classroomUsersCount > 0)
                                                    <div class="dropdown">
                                                        <a class="btn float-right" href="#" role="button"
                                                            id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v primary"></i>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            @if(is_null(App\Models\Bookmark::where('teachable_id',$teachable->id)->where('user_id',auth()->user()->id)->first() ))
                                                                <a
                                                                    data-teachable_id="{{$teachable->id}}"
                                                                    class="dropdown-item dropdown-add  dropdown-hover">Tambahkan ke Backpack
                                                                </a>
                                                            @else
                                                                <a
                                                                    data-teachable_id="{{$teachable->id}}"
                                                                    class="dropdown-item dropdown-remove  dropdown-hover">Hapus dari Backpack
                                                                </a>
                                                            @endif
                                                            
                                                            @if ($teachable->teachable_type == 'quiz')
                                                                <a href="{{ route('allquiz', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                                    class="dropdown-item">Lihat Daftar Pengumpulan </a>
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
                                                                <a href="{{ route('allAssignment', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                                    class="dropdown-item">Lihat Daftar Pengumpulan </a>
                                                                <a href="{{ route('editAssignment', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                                    class="dropdown-item">Edit </a>
                                                                <a class="dropdown-item btn delete"
                                                                    data-url="{{ route('destroyAssignment', $teachable->teachable_id) }}">
                                                                    Hapus</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                @endhasanyrole
                                                @hasanyrole('student|owner')
                                                @if(is_null(App\Models\Bookmark::where('teachable_id',$teachable->id)->where('user_id',auth()->user()->id)->first() ))
                                                    <i 
                                                        data-slug="{{$classrooms->slug}}"
                                                        data-teachable_id="{{$teachable->id}}" 
                                                        class="onClick fa fa-bookmark float-right bookmark-clik bookmark-default add" 
                                                        aria-hidden="true">
                                                    </i>
                                                @else
                                                    <i 
                                                        data-slug="{{$classrooms->slug}}"
                                                        data-teachable_id="{{$teachable->id}}"  
                                                        class="onClick fa fa-bookmark float-right bookmark-clik bookmark-active remove" 
                                                        aria-hidden="true">
                                                    </i>
                                                @endif
                                                @endhasanyrole
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
        $(".dropdown-add").click(function(e) {
            e.preventDefault();
            let slug = $(this).data('slug');
            let teachable_id = $(this).data('teachable_id');
            let url = '{{ route("add_boomark") }}';
            $.ajax({
                type: 'post',
                url: url,
                data: { 
                    teachable_id: teachable_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('add bookmark : ',response);
                    if(response.status == 200){ 
                        $('.onClick').click(removeToAdd); 
                        window.location.href = '';

                    }
                }
            });
        });
 
        $(".dropdown-remove").click(function(e) {
            e.preventDefault();
            let slug = $(this).data('slug');
            let teachable_id = $(this).data('teachable_id');
            let url = '{{ route("remove_boomark") }}';
            $.ajax({
                type: 'post',
                url: url,
                data: { 
                    teachable_id: teachable_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('remove bookmark : ',response);
                    if(response == 200){
                        $('.onClick').click(removeToAdd); 
                        window.location.href = '';

                    }
                }
            });
        });
    </script>
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
                confirmButtonColor: '#1b5cb8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Gabung',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });
 
        $(".add").click(function(e) {
            e.preventDefault();
            let slug = $(this).data('slug');
            let teachable_id = $(this).data('teachable_id');
            let url = '{{ route("add_boomark") }}';
            $.ajax({
                type: 'post',
                url: url,
                data: { 
                    teachable_id: teachable_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('add bookmark : ',response);
                    if(response.status == 200){ 
                        $('.onClick').click(removeToAdd); 
                        window.location.href = '';

                    }
                }
            });
        });
 
        $(".remove").click(function(e) {
            e.preventDefault();
            let slug = $(this).data('slug');
            let teachable_id = $(this).data('teachable_id');
            let url = '{{ route("remove_boomark") }}';
            $.ajax({
                type: 'post',
                url: url,
                data: { 
                    teachable_id: teachable_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('remove bookmark : ',response);
                    if(response == 200){
                        $('.onClick').click(removeToAdd); 
                        window.location.href = '';

                    }
                }
            });
        });

        function removeToAdd() {
            $('.onClick').attr('class', 'onClick fa fa-bookmark float-right bookmark-clik bookmark-default add');
        }

        function addToRemove() {
            $('.onClick').attr('class', 'onClick fa fa-bookmark float-right bookmark-clik bookmark-active remove');
        }

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
                confirmButtonColor: '#1b5cb8',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tutup'
            })
        });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(document).ready(function() {
            $('[data-togglebtn="tooltip"]').tooltip();
        });

    </script>
@endpush
