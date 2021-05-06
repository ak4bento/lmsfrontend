@extends('frontend.layouts.app')

@section('content')
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- /.col -->
                        @if ($classWork->type == 'video')
                            <div class="col-md-12">
                                <div class="card">
                                    {{-- <iframe style="height: 66vh;" src="https://www.youtube.com/embed/Pfj7HH0qQao" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                    <video id="player" playsinline controls >
                                        <source src="http://{{ $classWork->data }}" type="video/mp4" size="576"> />
                                    </video>

                                </div>
                            </div>
                        @endif
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Box Comment -->
                                    <div class="card card-widget card-primary card-outline">
                                        <div class="card-header">
                                            <span class="card-title" style="font-size: 15px">
                                                Diterbitkan - {{ $classWork->created_at }}
                                            </span>
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
                                                {!! $classWork->description !!}
                                            </p>
                                            @if ($classWork->type == 'audio')
                                                <a target="_blank"
                                                    href="{{ asset('files/' . App\Models\Media::where('media_type', 'resource')->where('media_id', $classWork->id)->first()->file_name,) }}">
                                                    {{ App\Models\Media::where('media_type', 'resource')->where('media_id', $classWork->id)->first()->name }}
                                                </a>
                                            @endif
                                            @if ($classWork->type == 'documents')
                                                <iframe src="{{ asset('files/' . App\Models\Media::where('media_type', 'resource')->where('media_id', $classWork->id)->first()->file_name,) }}" frameborder="0" style="width: 100%;height: 50vh;"></iframe>
                                            @endif
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer card-comments">
                                            @foreach ($discussions as $key)
                                                <div class="card-comment">
                                                    <!-- User image -->
                                                    <img class="img-circle img-sm"
                                                        src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Image">

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
                                        <!-- /.card-footer -->
                                        <div class="card-footer">
                                            <form action="#" method="post">
                                                @csrf
                                                <img class="img-fluid img-circle img-sm"
                                                    src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="Alt Text">
                                                <!-- .img-push is used to add margin to elements next to floating images -->
                                                <div class="img-push">
                                                    <textarea type="text" class="form-control form-control-sm" name="comment"
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
        </section>
    </div>
@endsection
