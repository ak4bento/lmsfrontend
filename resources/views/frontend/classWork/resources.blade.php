@extends('frontend.layouts.app')

@section('content')
<div class="container">

    <div class="container">
        <h1 class="display-4"> {{ $classWork->title }} </h1>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card">
                            <video id="player" playsinline controls data-poster="{{ $classWork->data}}">
                                <source src="{{ $classWork->data }}" type="video/mp4" size="576"> />
                                <source src="{{ $classWork->data }}" type="video/mp4" size="876"> />
                                <!-- Captions are optional -->
                                <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en"
                                    default />
                            </video>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-12">
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
                                        @foreach($discussions as $key)
                                            <div class="card-comment">
                                                <!-- User image -->
                                                <img class="img-circle img-sm"
                                                    src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Image">

                                                <div class="comment-text">
                                                    <span class="username">
                                                        {{ DB::table('users')->where('id', $key->user_id)->first()->name }}
                                                        <span class="text-muted float-right">{{ $key->created_at }}</span>
                                                    </span><!-- /.username -->
                                                    {{ $key->message }}
                                                </div>
                                                <!-- /.comment-text -->
                                            </div>
                                            <!-- /.card-comment -->
                                        @endforeach
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
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi</h5>
                    <p class="card-text">{{ $classWork->description }}.</p>
                </div>
            </div>
        </div> --}}
    </section>
</div>
@endsection
