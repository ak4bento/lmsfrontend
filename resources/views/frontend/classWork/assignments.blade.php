@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="display-4"> {{ $classWork->title }} </h1>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi</h5>
                    <p class="card-text">{{ $classWork->description }}.</p>

                    @if(is_object($complete))

                    <div class="alert alert-success alert-dismissible">
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                        File sudah di kumpul
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Unggah Tugas</h3>
                    <p class="card-text">
                        <form action="/upload-assigment" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <!-- <label for="customFile">Custom File</label> -->

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </div>
                            <input type="hidden" name="media_id" value="{{ $classWork->id }}">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Unggah</button>
                            </div>
                        </form>
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
                        @csrf
                        <img class="img-fluid img-circle img-sm"
                            src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="Alt Text">
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="img-push">
                            <textarea type="text" class="form-control form-control-sm" name="comment" placeholder="Press enter to post comment"></textarea>
                            <input type="submit" class="btn btn-primary btn-sm float-right" value="kirim" style="margin-top:5px">
                        </div>
                    </form>
                </div>
                <!-- /.card-footer -->
            </div>
        </section>
    </div>
@endsection
