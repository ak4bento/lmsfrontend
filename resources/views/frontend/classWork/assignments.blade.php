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
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi</h5>
                    <p class="card-text">{{ $classWork->description }}.</p>

                    @if (is_object($complete))

                        <div class="alert alert-success alert-dismissible">
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            File sudah di kumpul
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card col-12">
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
            </div>
        </section>
    </div>
@endsection
