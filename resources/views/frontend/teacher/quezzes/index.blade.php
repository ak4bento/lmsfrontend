@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <section class="content-header col-lg-12">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1>Daftar Pengumpulan Kuis</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">
                                        <a href="{{ route('classroom.detail', $classroom->slug) }}">Kelas</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Daftar Pengumpulan Kuis
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="content px-3 col-lg-12">
                <div class="row">
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="card card-primary card-outline col-sm-12 col-md-12 col-lg-12">
                        <div class="card-header align-items-center">
                            <div class="d-flex justify-content-between">
                                <p class="card-title">{{ $quizzes->title }}</p>
 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                @include('frontend.teacher.quezzes.table')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
