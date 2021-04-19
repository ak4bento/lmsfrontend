@extends('frontend.layouts.app') @section('content')
<div class="container">
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Kuis</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quiz</li>
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
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Box Comment -->
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                                <img class="img-circle"
                                                    src="https://img.icons8.com/carbon-copy/2x/file.png"
                                                    alt="User Image">
                                                <span class="username"><a href="#">{{ $classWork->title }}</a></span>
                                                <span class="description">Shared publicly -
                                                    {{ $classWork->created_at }}
                                                </span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <!-- post text -->
                                            <p>
                                                {{ $classWork->description }}
                                            </p>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer card-comments">
                                            <div class="card-comment">
                                                <!-- User image -->
                                                <img class="img-circle img-sm"
                                                    src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Image">

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
                                                    src="{{ asset('dist/img/user5-128x128.jpg') }}" alt="User Image">

                                                <div class="comment-text">
                                                    <span class="username">
                                                        Nora Havisham
                                                        <span class="text-muted float-right">8:03 PM Today</span>
                                                    </span><!-- /.username -->
                                                    The point of using Lorem Ipsum is that it hrs a morer-less
                                                    normal distribution of letters, as opposed to using
                                                    'Content here, content here', making it look like readable English.
                                                </div>
                                                <!-- /.comment-text -->
                                            </div>
                                            <!-- /.card-comment -->
                                        </div>
                                        <!-- /.card-footer -->
                                        <div class="card-footer">
                                            <form action="#" method="post">
                                                <img class="img-fluid img-circle img-sm"
                                                    src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="Alt Text">
                                                <!-- .img-push is used to add margin to elements next to floating images -->
                                                <div class="img-push">
                                                    <textarea type="text" class="form-control form-control-sm"
                                                        placeholder="Press enter to post comment"></textarea>
                                                    <input type="submit" class="btn btn-primary btn-sm float-right"
                                                        value="kirim" style="margin-top:5px">
                                                </div>

                                            </form>
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <!-- Box Comment -->
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                                <img class="img-circle"
                                                    src="https://img.icons8.com/carbon-copy/2x/file.png"
                                                    alt="User Image">
                                                <span class="username"><a href="#">{{ $classWork->title }}</a></span>
                                                <span class="description">Shared publicly -
                                                    {{ $classWork->created_at }}
                                                </span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <!-- post text -->
                                            <p>
                                                {{ $classWork->description }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <h3 class="profile-username">Completion Status</h3>
                                    <p class="text-success"><i class="fas fa-check-circle"></i> Completed</p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <a data-url="{{ url('quizzes/quiz') }}/{{ $classWork->id }}" type="button"
                                class="btn btn-block btn-primary btn-lg quiz">Take Quiz</a>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
@push('page_scripts')
<script>
    $(".quiz").click(function(e) {
        e.preventDefault();
        // let id = $(this).data('id');
        let url = $(this).data('url');

        // url = url.replace(':id', id);
        console.log('url', url);
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Setelah menekan Mulai, waktu kuis akan berjalan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText:'Batal',
            confirmButtonText: 'Mulai'
        }).then((result) => {
            if (result.value) {
                // $(".form").submit();
                // window.location.href = form.submit();
                window.location.href = url;
                // window.location.href = "{{ url('/candidate/delete/') }}" + "/" + postId;
            }
        })

    });
</script>
@endpush