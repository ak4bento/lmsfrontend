@extends('frontend.layouts.app') @section('content')
    <div class="container">
        <section class="content-header">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>{{ $classWork->title }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                <li class="breadcrumb-item active">
                                    <a href="{{ route('classroom.detail', $classrooms->slug) }}">Kelas</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $classWork->title }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            @hasanyrole('student')

                            <div class="col-md-9">
                                @endhasanyrole
                                @hasanyrole('teacher')

                                <div class="col-md-12">
                                    @endhasanyrole

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-widget">
                                                <div class="card-header">
                                                    Diposting
                                                    {{ $classWork->created_at }}
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <p>
                                                        {!! $classWork->description !!}
                                                    </p>
                                                </div>
                                                <div class="card-footer card-comments">
                                                    <div class="card-comment">
                                                        <!-- User image -->
                                                        <img class="img-circle img-sm"
                                                            src="{{ asset('dist/img/user3-128x128.jpg') }}"
                                                            alt="User Image">

                                                        <div class="comment-text">
                                                            <span class="username">
                                                                Maria Gonzales
                                                                <span class="text-muted float-right">8:03 PM Today</span>
                                                            </span><!-- /.username -->
                                                            It is a long established fact that a reader will be distracted
                                                            by the readable content of a page when looking at its layout.
                                                        </div>
                                                        <!-- /.comment-text -->
                                                    </div>
                                                    <!-- /.card-comment -->
                                                    <div class="card-comment">
                                                        <!-- User image -->
                                                        <img class="img-circle img-sm"
                                                            src="{{ asset('dist/img/user5-128x128.jpg') }}"
                                                            alt="User Image">

                                                        <div class="comment-text">
                                                            <span class="username">
                                                                Nora Havisham
                                                                <span class="text-muted float-right">8:03 PM Today</span>
                                                            </span><!-- /.username -->
                                                            The point of using Lorem Ipsum is that it hrs a morer-less
                                                            normal distribution of letters, as opposed to using
                                                            'Content here, content here', making it look like readable
                                                            English.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <form action="#" method="post">
                                                        <img class="img-fluid img-circle img-sm"
                                                            src="{{ asset('dist/img/user4-128x128.jpg') }}"
                                                            alt="Alt Text">
                                                        <div class="img-push">
                                                            <textarea type="text" class="form-control form-control-sm"
                                                                placeholder="Press enter to post comment"></textarea>
                                                            <input type="submit" class="btn btn-primary btn-sm float-right"
                                                                value="kirim" style="margin-top:5px">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @hasanyrole('student')
                                <div class="col-md-3">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <h3 class="profile-username">Status Penyelesaian Kuis</h3>
                                            @if ($quiz_attempts >= $teachable->max_attempts_count)
                                                <p class="text-success"><i class="fas fa-check-circle"></i>
                                                    Selesai</p>
                                            @else
                                                <p class="text-danger"><i class="fas fa-times-circle"></i>
                                                    Tidak Selesai</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($quiz_attempts < $teachable->max_attempts_count)
                                        <a data-url="{{ url('quizzes/quiz') }}/{{ $classWork->id }}" type="button"
                                            class="btn btn-block btn-primary btn-lg quiz">
                                            Ikuti Kuis
                                        </a>
                                    @else
                                        <a href="{{ url('submited-quiz') }}/{{ $classWork->id }}" type="button"
                                            class="btn btn-block btn-primary btn-lg">
                                            Lihat Jawaban
                                        </a>
                                    @endif
                                </div>
                                @endhasanyrole
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
@push('page_scripts')
    <script>
        $(".quiz").click(function(e) {
            e.preventDefault();
            let url = $(this).data('url');
            console.log('url', url);
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Setelah menekan Mulai, waktu kuis akan berjalan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#174ea6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Mulai'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })

        });

    </script>
@endpush
