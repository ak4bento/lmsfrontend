@extends('frontend.layouts.app') @section('content')
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi</h5>
                    <p class="card-text">{{ $classWork->description }}.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection