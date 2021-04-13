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
                                <video controls crossorigin playsinline id="player"
                                    poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                    <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                                        type="video/mp4" size="576">
                                    <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4"
                                        type="video/mp4" size="720">
                                    <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4"
                                        type="video/mp4" size="1080">

                                    <!-- Caption files -->
                                    <track kind="captions" label="English" srclang="en"
                                        src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                                        default>
                                    <track kind="captions" label="Français" srclang="fr"
                                        src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">
                                    <!-- Fallback for browsers that don't support the <video> element -->
                                    <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                                        download>Download</a>
                                </video>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi</h5>
                    <p class="card-text">{{ $classWork->description }}.</p>
                </div>
            </div>
        </section>
    </div>
@endsection
