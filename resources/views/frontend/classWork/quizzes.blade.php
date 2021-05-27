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
                                @hasanyrole('teacher|owner')

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
                                                    @foreach ($discussions as $key)
                                                        <div class="card-comment">
                                                            <!-- User image -->
                                                            <img class="img-circle img-sm"
                                                            src="files/{{ Media::where('media_type','user')->where('media_id',$key->user_id)->latest('created_at')->first())->file_name ?? 'avatar.png' }}" alt="User Image">

                                                            <div class="comment-text">
                                                                <span class="username">
                                                                    {{ DB::table('users')->where('id', $key->user_id)->first()->name }}
                                                                    <span
                                                                        class="text-muted float-right">{{ $key->created_at }}</span>
                                                                </span><!-- /.username -->
                                                                {{ $key->message }}
                                                            </div>
                                                            <!-- /.comment-text -->
                                                        </div>
                                                        <!-- /.card-comment -->
                                                    @endforeach
                                                </div>
                                                <div class="card-footer">
                                                    <form action="#" method="post">
                                                        @csrf
                                                        <img class="img-fluid img-circle img-sm"
                                                        src="files/{{ Media::where('media_type','user')->where('media_id', Auth::user()->id)->latest('created_at')->first())->file_name ?? 'avatar.png' }}" alt="Alt Text">
                                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                                        <div class="img-push">
                                                            <textarea type="text" class="form-control form-control-sm" name="comment"
                                                                placeholder="Press enter to post comment"></textarea>
                                                            <input type="submit" class="btn btn-primary btn-sm float-right"
                                                                value="kirim" style="margin-top:5px">
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @hasanyrole('student')
                                <div class="col-md-3">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            @if(is_null($grade))
                                                <h3  style="text-align:center" class="profile-username">Status Penyelesaian Kuis</h3>
                                            @else
                                                <h3  style="text-align:center" class="profile-username">Nilai</h3>
                                            @endif
                                            @if ($quiz_attempts >= 1)
                                            <h1 style="text-align:center">
                                                {{ $grade->grade }}
                                            </h1>
                                                <p  style="text-align:center" class="text-success"><i class="fas fa-check-circle"></i>
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
                confirmButtonColor: '#1b5cb8',
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
